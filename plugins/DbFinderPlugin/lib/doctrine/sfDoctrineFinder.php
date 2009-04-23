<?php

/*
 * This file is part of the sfPropelFinder package.
 * 
 * (c) 2007 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
class sfDoctrineFinder extends sfModelFinder
{
  protected
    $connection    = null,
    $class         = null,
    $alias         = null,
    $aliases       = array(),
    $object        = null,
    $reinit        = true,
    $query         = null,
    $queryPattern  = '',
    $queryArgs     = array(),
    $namedPatterns = array(),
    $namedArgs     = array(),
    $argNumber     = 0,
    $queryListener = null,
    $relatedTables = array(),
    $relationPath  = array(),
    $withClasses   = array(),
    $withColumns   = array(),
    $culture       = null,
    $cacheEngine     = null,
    $cacheLifetime   = null,
    $select          = null,
    $keyType         = null;
  
  public function getClass()
  {
    return $this->class;
  }
  
  /**
   * Caution: reinitializes the finder's Doctrine_Query object
   */
  public function setClass($class, $alias = '')
  {
    $this->initialize($this->connection, $class, $alias);
    $this->class = $class;
    $this->alias = $alias;
    $this->object = new $class();
    $this->relatedTables = array($class => $this->object->getTable());
    $this->relationPath[$class] = '';
    
    return $this;
  }

  public function initialize($connection, $class, $alias)
  {
    $this->query = Doctrine_Query::create($connection)->from($class . ' ' . $alias);
    $this->queryListener = sfDoctrineFinderListener::getInstance();
    $this->aliases = array();
    $this->select = null;
    $this->keyType = null;

    if($alias)
    {
      $this->addAlias($class, $alias);
    }
    $this->reinitWithClasses();
    $this->reinitWithColumns();
    
    return $this;
  }
  
  public function getConnection()
  {
    return $this->connection;
  }

  /**
   * Caution: reinitializes the finder's Doctrine_Query object
   */
  public function setConnection($connection)
  {
    $this->connection = $connection;
    if($this->class)
    {
      $this->initialize($connection, $this->class, $this->alias);
    }
    
    return $this;
  }
  
  public function buildQuery()
  {
    // Temporarily disabling the the subquery algorithm (enabled again in cleanup()).
    // Read more at http://www.phpdoctrine.org/documentation/manual/0_11/?one-page#dql-doctrine-query-language:limit-and-offset-clauses:the-limit-subquery-algorithm
    $this->object->getTable()->setAttribute(Doctrine::ATTR_QUERY_LIMIT, Doctrine::LIMIT_ROWS);
    
    $this->addMissingJoins();
    
    // Add columns
    if(!is_null($this->select))
    {
      $columnNames = is_array($this->select) ? $this->select : array($this->select);
      $select = array();
      foreach ($columnNames as $column)
      {
        // check if the column was added by a withColumn, if not add it
        if(!array_key_exists($column, $this->getWithColumns()))
        {
          $select []= $this->getColName($column);
        }
      }
    }
    else
    {
      $select = array(($this->alias ? $this->alias : $this->class).'.*');
    }
    // Add with classes columns
    foreach ($this->getWithClasses() as $class)
    {
      $select []= $this->getAlias($class).'.*';
    }
    // Add with columns
    if($this->hasWithColumns())
    {
      foreach ($this->getWithColumns() as $alias => $withColumn)
      {
        if($withColumn['class'] == 'calculated')
        {
          // Add a column to the SELECT statement, with the alias
          $select []= $withColumn['column'] . ' ' . $alias;
        }
        else
        {
          // Identity Map doesn't play well with custom column names
          Doctrine::getTable($withColumn['class'])->clear();
          // Add a column to the SELECT statement, with the alias
          $select []= $withColumn['alias'] . '.' . $withColumn['column'] . ' ' . $alias;
          $relationPath = $this->relationPath[$withColumn['relation']];
          if(substr_count($relationPath, '.') > 1)
          {
            // Relation has more than one step, so we must tell doctrine how to hydrate it
            // by specifying intermediate columns
            $steps = explode('.', $relationPath);
            // Leave the last one (already taken care of) and the first (empty) one
            array_pop($steps);
            array_shift($steps);
            $latestTable = $this->relatedTables[$this->class];
            foreach ($steps as $step)
            {
              // steps are relation names
              $latestTable = $latestTable->getRelation($step)->getTable();
              $cols = $latestTable->getIdentifierColumnNames();
              $select []= $this->getAlias($latestTable->getClassnameToReturn()). '.' . array_pop($cols);
            }
          }
        }
      }
      // Identity Map doesn't play well with custom column names
      Doctrine::getTable($this->class)->clear();
      // Reset template cache
      $this->object->getTable()->setMethodOwner('getColumn', false);
      // Set template
      $this->object->getTable()->addTemplate('Extendable', new sfDoctrineFinderRecordTemplate());
    }
    // Combine it all
    $this->query->select(join($select, ', '));
    
    // Add conditions
    if($this->queryPattern)
    {
      $this->query->addWhere($this->queryPattern, $this->queryArgs);
      $this->queryPattern = '';
      $this->queryArgs = array();
    }
    
    return $this->query;
  }
  
  /**
   * Doctrine 0.11 adds primary key columns to the SQL query.
   * E.g. when requesting 'Article.Title' + 'Category.Name', Doctrine actually asks for 'Article.Id' + 'Article+Title' + 'Category.Id' + 'Category.Name'
   * sfDoctrineFinder needs to know those additional columns
   * In ordert o remove them from the final result
   * This method is only used when selct() was called
   * 
   * @param array $columns The list of columns requested by the user (e.g array('Article.Title', 'Category.Name'))
   * 
   * @return array The indices to be ignored in the result array (e.g. array('0' => true, '2' => true))
   */
  protected function getDoctrineAddedColumns($columns)
  {
    if(Doctrine::VERSION != '0.11.0') return array();
    $tmp = array();
    foreach($columns as $column)
    {
      if(!array_key_exists($column, $this->getWithColumns()))
      {
        list($class, $colName) = explode('.', $this->getColName($column));
        $tmp[$class][] = $colName;
      }
    }
    $ignore = array();
    $index = 0;
    foreach ($tmp as $class => $columns)
    {
      $class = $this->isAlias($class) ? $this->getClassFromAlias($class) : $class;
      $table = new $class();
      $mainIdentifier = $table->getTable()->getIdentifier();
      if(!in_array($mainIdentifier, $columns))
      {
        // Doctrine will add the identifier
        $ignore[$index] = true;
        $index +=1;
      }
      $index+= count($columns);
    }
    
    return $ignore;
  }
  
  /**
   * Transform a brute result array to a clean one
   * When using select(), the finder uses PDO::FETCH_NUM and therefore gets a blind array
   * This array needs to get proper key names (the ones asked in select)
   * And it needs to be cleaned up of columns added by Doctrine 0.11 (see getDoctrineAddedColumns)
   * 
   * @param array $resultArray A list of result, as returned by PDOStatement::fetchAll(PDO::FETCH_NUM)
   *
   * @param array The columns requested by the user. Associative by default, the array uses the keys asked in select()
   */
  protected function cleanupResultArray($resultArray)
  {
    $columnNames = is_array($this->select) ? $this->select : array($this->select);
    $ignore = $this->getDoctrineAddedColumns($columnNames);
    $results = array();
    foreach ($resultArray as $row)
    {
      if($ignore)
      {
        // get rid of the columns added by Doctrine
        $row = array_diff_key($row, $ignore);
        // reindex the columns
        $row = array_values($row);
      }
      foreach ($row as $key => $value)
      {
        if (is_array($this->select))
        {
          $finalRow = array();
          foreach($row as $index => $value)
          {
            if($this->keyType == self::ASSOCIATIVE)
            {
              $finalRow[$columnNames[$index]] = $value;
            }
            else
            {
              $finalRow[] = $value;
            }
          }
        }
        else
        {
          $finalRow = $row[0];
        }
      }
      $results[] = $finalRow;
    }
    
    return $results;
  }
  
  /**
   * Returns the internal query object
   *
   * @return Doctrine_Query
   */
  public function getQueryObject()
  {
    return $this->buildQuery();
  }
  
  /**
   * Replaces the internal query object
   *
   * @return sfDoctrineFinder The current finder
   */
  public function setQueryObject($query)
  {
    $this->query = $query;
    
    return $this;
  }
  
  protected function addAlias($class, $alias = '')
  {
    if(!$alias) list($class, $alias) = $this->getClassAndAliasForDoctrine($class);
    $this->aliases[$alias] = $class;
  }
  
  /**
   * $aliases property is a $class => $alias hash
   */
  protected function getAlias($class)
  {
    if(in_array($class, $this->aliases))
    {
      return array_search($class, $this->aliases);
    }
    
    return $class;
  }
  
  protected function isAlias($alias)
  {
    return array_key_exists($alias, $this->aliases);
  }
  
  protected function getClassFromAlias($alias)
  {
    return $this->aliases[$alias];
  }
  
  // Finder initializers
  
  /**
   * Mixed initializer
   * Accepts either a string (Model object class) or an array of model objects
   *
   * @param mixed $from The data to initialize the finder with
   * @param mixed $connection Optional connection object
   *
   * @return sfDoctrineFinder a finder object
   * @throws Exception If the data is neither a classname nor an array
   */
  public static function from($from, $connection = null)
  {
    if (is_string($from))
    {
      return self::fromClass($from, $connection);
    }
    if (is_array($from) || $from instanceof Doctrine_Collection)
    {
      return self::fromCollection($from);
    }
    throw new Exception('sfDoctrineFinder::from() only accepts a model object classname or an array of model objects');
  }
  
  /**
   * Array initializer
   *
   * @param array $array Array of Primary keys
   * @param string $class Model classname on which the search will be done
   *
   * @return sfDoctrineFinder a finder object
   */
  public static function fromArray($array, $class, $pkName)
  {
    $finder = self::fromClass($class);
    $finder->where($pkName, 'in', $array);
    
    return $finder;
  }
  
  /**
   * Class initializer
   *
   * @param string $from Model classname on which the search will be done
   * @param mixed $connection Optional connection object
   *
   * @return sfDoctrineFinder a finder object
   */
  public static function fromClass($class, $connection = null)
  {
    if(strpos($class, ' ') !== false)
    {
      list($realClass, $alias) = explode(' ', $class);
    }
    else
    {
      $realClass = $class;
    }
    if(is_subclass_of($realClass, 'Doctrine_Record'))
    {
      $me = __CLASS__;
      $finder = new $me($class, $connection);
    }
    else
    {
       throw new Exception('sfDoctrineFinder::fromClass() only accepts a Doctrine model classname');
    }
    
    return $finder;
  }
  
  /**
   * Collection initializer
   *
   * @param array $from Array of model objects of the same class
   * @param string $class Optional classname of the desired objects
   * @param string $class Optional column name of the primary key
   *
   * @return sfDoctrineFinder a finder object
   * @throws Exception If the array is empty, contains not model objects or composite objects
   */
  public static function fromCollection($collection, $class = '', $pkName = '')
  {
    $pks = array();
    foreach($collection as $object)
    {
      if($class != get_class($object))
      {
        if($class)
        {
          throw new Exception('A sfDoctrineFinder can only be initialized from an array of objects of a single class');
        }
        if($object instanceof Doctrine_Record)
        {
          $class = get_class($object);
        }
        else
        {
          throw new Exception('A sfDoctrineFinder can only be initialized from an array of Doctrine objects');
        }
      }
      $identifier = array_values($object->identifier());
      if(count($identifier) == 1)
      {
        $identifier = array_shift($identifier);
      }
      $pks []= $identifier;
    }
    if(!$class)
    {
      throw new Exception('A sfDoctrineFinder cannot be initialized with an empty array');
    }
    $tempObject = new $class();
    foreach ($tempObject->getTable()->getColumns() as $name => $column)
    {
      if(array_key_exists('primary', $column))
      {
        if($pkName)
        {
          throw new Exception('A sfDoctrineFinder cannot be initialized from an array of objects with several foreign keys');
        }
        else
        {
          $pkName = $name;
        }
      }
    }
    
    return self::fromArray($pks, $class, $pkName);
  }
  
  public function getObject()
  {
    return $this->object;
  }

  public function getLatestQuery()
  {
    return $this->queryListener->getLatestQuery();
  }
  
  public function addWithClass($class)
  {
    $this->withClasses []= $class;
    
    return $this;
  }
  
  public function getWithClasses()
  {
    return $this->withClasses;
  }
  
  public function reinitWithClasses()
  {
    $this->withClasses = array();
    
    return $this;
  }
  
  public function hasWithColumns()
  {
    return !empty($this->withColumns);
  }
  
  public function getWithColumns()
  {
    return $this->withColumns;
  }
  
  public function reinitWithColumns()
  {
    $this->withColumns = array();
    
    return $this;
  }
  
  // Finder output
  
  public function select($columnArray, $keyType = self::ASSOCIATIVE)
  {
    if(!$columnArray)
    {
      throw new Exception('You must ask for at least one column');
    }
    if ($columnArray == '*')
    {
      $select = array();
      foreach ($this->getObject()->getTable()->getColumnNames() as $field) 
      {
        $select []= $this->class . '.' . self::camelize($field);
      }
      $this->select = $select;
    }
    else
    {
      $this->select = $columnArray;
    }
    $this->keyType = $keyType;
    $this->query->setHydrationMode(Doctrine::HYDRATE_NONE);
    
    return $this;
  }
  
  // Finder Executers
  
  /**
   * Returns the number of records matching the finder
   *
   * @param Boolean $distinct Whether the count query has to add a DISTINCT keyword (unsupported)
   *
   * @return integer Number of records matching the finder
   */
  public function count($distinct = false)
  {
    $res = $this->buildQuery()->count();
    $this->cleanup();
    
    return $res;
  }
  
  /**
   * Executes the finder and returns the matching Doctrine objects
   *
   * @param integer $limit Optional maximum number of results to retrieve
   *
   * @return array A list of Doctrine_Record objects
   */
  public function find($limit = null)
  {
    if($limit)
    {
      $this->query->limit($limit);
    }
    $res = $this->buildQuery()->execute();
    if(!is_null($this->select))
    {
      $res = $this->cleanupResultArray($res);
    }
    $this->cleanup();
    
    return $res;
  }
  
  /**
   * Limits the search to a single result, and executes the finder
   * Returns the first Doctrine_Record object matching the finder
   *
   * @return mixed a Doctrine_Record object or null
   */
  public function findOne()
  {
    $this->query->limit(1);
    $res = $this->buildQuery()->execute();
    if(!is_null($this->select))
    {
      $res = $this->cleanupResultArray($res);
    }
    $res = isset($res[0]) ? $res[0] : (is_array($this->select) ? array() : null);
    $this->cleanup();
    
    return $res;
  }
  
  /**
   * Returns the last record matching the finder
   * Optionally, you can specify the column to sort on
   * If no column is passed, the finder guesses the column to use
   * @see guessOrder()
   *
   * @param string $columnName Optional: The column to order by
   *
   * @return mixed a Doctrine_Record object or null
   */
  public function findLast($columnName = null)
  {
    if($columnName)
    {
      $this->orderBy($columnName, 'desc');
    }
    else
    {
      $this->guessOrder('desc');
    }
    
    return $this->findOne();
  }
  
  /**
   * Returns the first record matching the finder
   * Optionally, you can specify the column to sort on
   * If no column is passed, the finder guesses the column to use
   * @see guessOrder()
   *
   * @param string $columnName Optional: The column to order by
   *
   * @return mixed a Doctrine_Record object or null
   */
  public function findFirst($columnName = null)
  {
    if($columnName)
    {
      $this->orderBy($columnName, 'asc');
    }
    else
    {
      $this->guessOrder('asc');
    }
    
    return $this->findOne();
  }
  
  /**
   * Adds a condition on a column and returns the records matching the finder
   *
   * @param string $columnName Name of the columns
   * @param mixed $value
   * @param integer $limit Optional maximum number of records to return
   *
   * @return array A list of Doctrine_Record Propel objects
   */
  public function findBy($columnName, $value, $limit = null)
  {
    $column = $this->getColName($columnName);
    $this->where($column, '=', $value);
    
    return $this->find($limit);
  }

  /**
   * Adds a condition on a column and returns the first record matching the finder
   * Useful to retrieve objects by a column which is not the primary key
   *
   * @param string $columnName Name of the columns
   * @param mixed $value
   *
   * @return mixed a Doctrine_Record object or null
   */
  public function findOneBy($columnName, $value)
  {
    $column = $this->getColName($columnName);
    $this->where($column, '=', $value);
    
    return $this->findOne();
  }
  
  /**
   * Finds record(s) based on one or several primary keys
   * Takes into account hydrating methods previously called on the finder
   *
   * @param mixed $pk A primary kay, a composite primary key, or an array of primary keys
   *
   * @return mixed One or several Doctrine_Record records (based on the input)
   */
  public function findPk($pk)
  {
    $pkColumns = $this->getObject()->getTable()->getIdentifierColumnNames();
    if(($count = count($pkColumns)) > 1)
    {
      // composite primary key
      if(!is_array($pk))
      {
        throw new Exception(sprintf('Class %s has a composite primary key and expects %s parameters to retrieve a record by pk', $this->class, join(', ', $pkColumns)));
      } 
      else if (is_array($count[0]))
      {
        // array of arrays
        // sorry the finder can't do that on objects with composte primary keys
        throw new Exception('Impossible to find a list of Pks on an objects with composite primary keys');
      }
      for ($i=0; $i < $count; $i++)
      { 
        $this->addCondition('and', $pkColumns[$i], '=', $pk[$i]);
      }
      return $this->findOne();
    }
    else
    {
      // simple primary kay
      if(is_array($pk))
      {
        $this->addCondition('and', $pkColumns[0], ' IN ', $pk);
        return $this->find();
      }
      else
      {
        $this->addCondition('and', $pkColumns[0], '=', $pk);
        return $this->findOne();
      }
    }
  }
  
  /**
   * Deletes the records found by the finder
   * Beware that behaviors based on hooks in the object's delete() method
   * Will only be triggered if you force individual deletes, i.e. if you pass true as first argument
   *
   * @param Boolean $forceIndividualDeletes
   *
   * @return Integer Number of deleted rows
   */
  public function delete($forceIndividualDeletes = false)
  {
    if($forceIndividualDeletes)
    {
      $objects = $this->buildQuery()->delete()->execute();
      $nbDeleted = 0;
      foreach($objects as $object)
      {
        $object->delete();
        $nbDeleted++;
      }
    }
    else
    {
      if (!$this->buildQuery()->contains('where'))
      {
        // Empty queries don't return the number of deleted rows
        $this->query->addWhere('1 = 1');
      }
      $nbDeleted = $this->query->delete()->execute();
    }
    $this->cleanup();
    
    return $nbDeleted;
  }
  
  /**
   * Prepares a pager based on the finder
   * The pager is initialized (it knows how many pages it contains)
   * But it won't be populated until you call getResults() on it
   *
   * @param integer $page The current page (1 by default)
   * @param integer $maxPerPage The maximum number of results per page (10 by default)
   *
   * @return sfDoctrineFinderPager The initialized pager object
   */
  public function paginate($page = 1, $maxPerPage = 10)
  {
    // Children of sfDoctrinePager don't have a $class property, so we need to guess it
    $pager = new sfDoctrineFinderPager($this->class, $maxPerPage);
    $pager->setFinder($this);
    $pager->setPage($page);
    $pager->init();
    
    return $pager;
  }
  
  /**
   * Updates the records found by the finder
   * Beware that behaviors based on hooks in the object's save() method
   * Will only be triggered if you force individual saves, i.e. if you pass true as second argument
   *
   * @param Array $values Associative array of keys and values to replace
   * @param Boolean $forceIndividualSaves
   *
   * @return Integer Number of updated rows
   */
  public function set($values, $forceIndividualSaves = false)
  {
    if (!is_array($values))
    {
      throw new Exception('sfDoctrineFinder::set() expects an array as first argument');
    }
    if($forceIndividualSaves)
    {
      $records = $this->find();
      $columnsToUpdate = array();
      foreach ($values as $key => $value)
      {
        $key_details = $this->getColName($key, null, true);
        $columnsToUpdate[$key_details[1]] = $value;
      }
      foreach ($records as $record)
      {
        $record->synchronizeWithArray($columnsToUpdate);
        $record->save();
      }
      
      return count($records);
    }
    else
    {
      $this->buildQuery()->update($this->class. ' ' . $this->getAlias($this->class));
      foreach ($values as $key => $value)
      {
        $argName = ':param'.$this->argNumber;
        $this->argNumber++;
        $this->query->set($this->getColName($key), $argName, array($argName => $value));
      }
      $res = $this->query->execute();
      $this->cleanup();
      
      return $res;
    }
  }
  
  /**
   * Cleans up the query object (if necessary)
   *
   * @return sfDoctrineFinder the current finder object
   */
  protected function cleanup()
  {
    // Re-enabling the the subquery algorithm.
    $this->object->getTable()->setAttribute(Doctrine::ATTR_QUERY_LIMIT, Doctrine::LIMIT_RECORDS);
    
    if($this->reinit)
    {
      $this->initialize($this->connection, $this->class, $this->alias);
    }
    
    return $this;
  }
  
  /**
   * Adds missing Joins from with() and withColumn()
   */
  protected function addMissingJoins()
  {
    foreach ($this->getWithClasses() as $class)
    {
      if(!array_key_exists($class, $this->relations))
      {
        $this->join($class);
      }
    }
    
    return $this;
  }
  
  // Hydrating
  
  /**
   * Ask the finder to hydrate related records
   * Equivalent to Doctrine's JOIN DQL
   * Examples:
   *   // Article has an author, article has a category, and author has a group
   *   $articleFinder->with('Author')->find();
   *   $articleFinder->with('Author', 'Category')->find();
   *   $articleFinder->with('Author', 'Group')->find();
   *   $articleFinder->join('Author')->with('Group')->find();
   *   // By default, the finder uses a simple join (where) but you can force another join
   *   $articleFinder->leftJoin('Author')->with('Author')->find();
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function with($classes)
  {
    if(!is_array($classes))
    {
      $classes = func_get_args();
    }
    foreach($classes as $class)
    {
      if(strtolower($class) == 'i18n')
      {
        $this->withI18n();
      }
      else
      {
        list($relatedClass, $alias, $isTrueAlias) = $this->getClassAndAliasForDoctrine($class);
        $this->addWithClass($relatedClass);
      }
    }
    
    return $this;
  }
  
  /**
   * Ask the finder to hydrate related i18n records
   *
   * @param string $culture Optional culture value. If no culture is given, the current user's culture is used
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function withI18n($culture = null)
  {
    $culture = is_null($culture) ? sfContext::getInstance()->getUser()->getCulture() : $culture;
    $this->query->leftJoin($this->getAlias($this->class).'.Translation t');
    $this->query->addWhere('t.lang = :culture', array(':culture' => $culture));
    
    return $this;
  }

  /**
   * Ask the finder to hydrate related columns
   * Columns hydrated by way of withColumn() can be retrieved on the object via getColumn()
   * If the join was not explicitly declared earlier in the finder, it guesses it
   * Examples:
   *   $article = $articleFinder->join('Author')->withColumn('Author.Name')->findOne();
   *   // The join() can be omitted, in which case the finder will try to guess the join based on the schema
   *   $article = $articleFinder->withColumn('Author.Name')->findOne();
   *   // Columns added by way of withColumn() can be retrieved by getColumn()
   *   $authorName = $article->getColumn('Author.Name');
   *
   *   // Alias support
   *   $article = $articleFinder->withColumn('Author.Name', 'authorName')->findOne();
   *   $authorName = $article->getColumn('authorName');
   *
   *   // type support
   *   $article = $articleFinder->withColumn('Author.Name', 'authorName', 'string')->findOne();
   *   $authorName = $article->getColumn('authorName');
   *
   *   // Support for calculated columns
   *   $articles = articleFinder->
   *     join('Comment')->
   *     withColumn('COUNT(comment.ID)', 'NbComments')->
   *     groupBy('Article.Id')->
   *     find();
   *
   * @param string $column The column to add. Can be a calculated column
   * @param string $alias Optional alias for column retrieval
   * @param string $type Optional type converter to be sure the retrieved column has the correct type
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function withColumn($column, $alias = null, $type = null)
  {
    $isCalculationColumn = strpos($column, '(') !== false;
    if(!$alias)
    {
      if($isCalculationColumn)
      {
        throw new Exception('Calculated colums added with sfDoctrineFinder::withColumn() need an alias as second parameter');
      }
      else
      {
        $alias = $column;
      }
    }
    if ($isCalculationColumn)
    {
      list($column, $colnames) = $this->replaceNames($column);
      $this->withColumns[$alias] = array(
        'class'    => 'calculated',
        'column'   => $column,
      );
    }
    else
    {
      list($class, $columnName, $classAlias) = $this->getColName($column, null, true);
      $this->withColumns[$alias] = array(
        'class'    => $class,
        'relation' => $this->relations[$class]->getAlias(),
        'column'   => $columnName,
        'alias'    => $classAlias
      );
    }
    return $this;
  }
  
  // Finder Filters
  
  /**
   * Finder Fluid Interface for Doctrine_Query::distinct()
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function distinct()
  {
    $this->query->distinct();
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::limit()
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function limit($limit)
  {
    $this->query->limit($limit);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::offset()
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function offset($offset)
  {
    $this->query->offset($offset);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::addWhere()
   * Infers $column, $value, $comparison from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->where('IsPublished')
   *    => $query->addWhere('a.is_published = ?', array(true))
   *   $articleFinder->where('CommentId', 3)
   *    => $query->addwhere('a.comment_id = ?', array(3))
   *   $articleFinder->where('Title', 'like', '%foo')
   *    => $query->addWhere('a.title LIKE ?', array('%foo'))
   *
   * @param      string  $columnName PHPName of the column bearing the condition
   * @param      string  $valueOrOperator  Value if 2 arguments, operator otherwise
   * @param      string  $value  Value if 3 arguments (optional)
   * @param      string  $namedCondition  If condition is to be stored for later combination (see combine())
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function where()
  {
    $arguments = func_get_args();
    $columnName = array_shift($arguments);
    $column = $this->getColName($columnName);
    if(isset($arguments[2]))
    {
      $namedCondition = $arguments[2];
      unset($arguments[2]);
    }
    else
    {
      $namedCondition = null;
    }
    list($value, $comparison) = self::getValueAndComparisonFromArguments($arguments);
    $this->addCondition('and', $column, $comparison, $value, $namedCondition);
    
    return $this;
  }

  /**
   * Infers $column, $value, $comparison from $columnName and some optional arguments
   *
   * @param      string  $columnName PHPName of the column bearing the condition
   * @param      string  $valueOrOperator  Value if 2 arguments, operator otherwise
   * @param      string  $value  Value if 3 arguments (optional)
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function orWhere()
  {
    $arguments = func_get_args();
    $columnName = array_shift($arguments);
    $column = $this->getColName($columnName);
    list($value, $comparison) = self::getValueAndComparisonFromArguments($arguments);
    $this->addCondition('or', $column, $comparison, $value);
    
    return $this;
  }
  
  protected function addCondition($cond = 'and', $column, $comparison, $value, $namedCondition = null)
  {
    if($comparison == ' NOT IN ')
    {
      if($namedCondition)
      {
        throw new Exception('Conditions with an IN statement cannot be combined');
      }
      if($cond == 'or')
      {
        if(!method_exists($this->query, 'orWhereNotIn'))
        {
          throw new Exception('Conditions with a NOT IN cannot be used as an OR condition with Doctrine 0.11');
        }
        $this->query->orWhereNotIn($column, $value);
      }
      else
      {
        if(method_exists($this->query, 'andWhereNotIn'))
        {
          $this->query->andWhereNotIn($column, $value);
        }
        else
        {
          $this->query->whereNotIn($column, $value);
        }
      }
    }
    else if($comparison == ' IN ')
    {
      if($namedCondition)
      {
        throw new Exception('Conditions with an IN statement cannot be combined');
      }
      if($cond == 'or')
      {
        if(!method_exists($this->query, 'orWhereIn'))
        {
          throw new Exception('Conditions with an IN statement cannot be used as an OR condition with Doctrine 0.11');
        }
        $this->query->orWhereIn($column, $value);
      }
      else
      {
        if(method_exists($this->query, 'andWhereIn'))
        {
          $this->query->andWhereIn($column, $value);
        }
        else
        {
          $this->query->whereIn($column, $value);
        }
      }
    }
    else
    {
      if($namedCondition)
      {
        if(is_null($value))
        {
          $this->namedPatterns[$namedCondition] = sprintf('%s %s', $column, $comparison);
          $this->namedArgs[$namedCondition] = array();
        }
        else
        {
          $argName = ':param'.$this->argNumber;
          $this->argNumber++;
          $this->namedPatterns[$namedCondition] = sprintf('%s %s %s', $column, $comparison, $argName);
          $this->namedArgs[$namedCondition][$argName] = $value;
        }
      }
      else
      {
        // The operator of the first condition is ignored
        $cond = $this->queryPattern ? $cond : '';
        if(is_null($value))
        {
          $this->queryPattern .= sprintf(' %s %s %s', $cond, $column, $comparison);
        }
        else
        {
          $argName = ':param'.$this->argNumber;
          $this->argNumber++;
          $this->queryPattern .= sprintf(' %s %s %s %s', $cond, $column, $comparison, $argName);
          $this->queryArgs[$argName] = $value;
        }
      }
    }
  }
  
  /**
   * Allow for a custom condition and takes care of parameter escaping
   * Examples:
   *   $articleFinder->whereCustom('UPPER(Article.Title) = ?', $title)
   *    => $query->addWhere('UPPER(article.title) = ?', array($title))
   *   $articleFinder->whereCustom('CONCAT(Article.Title, ?) = ?, array('foo', $title));
   *    => $query->addWhere('CONCAT(Article.Title, ?) = ?', array('foo', $title))
   *   $articleFinder->whereCustom('UPPER(Article.Title) = %foo%', array('%foo%' => $title))
   *    => $query->addWhere('UPPER(article.title) = :p1', array('p1' => $title))
   *
   * @param      string  $condition SQL clause containing at least the complete name of a column
   * @param      mixed  $values Array of values to be escaped and replaced in the clause
   * @param      string  $namedCondition  If condition is to be stored for later combination (see combine())
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function whereCustom($condition, $values = array(), $namedCondition = null)
  {
    $this->addCustomCondition($condition, $values, 'And', $namedCondition);
    
    return $this;
  }
  
  /**
   * Allow for a custom OR condition and takes care of parameter escaping
   *
   * @see whereCustom()
   *
   * @param      string  $condition SQL clause containing at least the complete name of a column
   * @param      mixed  $values Array of values to be escaped and replaced in the clause
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function orWhereCustom($condition, $values = array())
  {
    $this->addCustomCondition($condition, $values, 'Or');
    
    return $this;
  }
  
  protected function addCustomCondition($condition, $values = array(), $comparison, $namedCondition = null)
  {
    list($condition, $colnames) = $this->replaceNames($condition);
    if(!$colnames)
    {
      throw new Exception('whereCustom() expects an expression containing complete column names');
    }
    if(!is_array($values))
    {
      $values = array($values);
    }
    if(!empty($values))
    {
      // replace token by PDO tokens
      $namedValues = array();
      while(strpos($condition, '?') !== false)
      {
        $argName = ':param'.$this->argNumber;
        $this->argNumber++;
        $pos = strpos($condition, '?');
        $condition = substr($condition, 0, $pos) . $argName . substr($condition, $pos + 1);
        $namedValues[$argName] = array_shift($values);
      }
      while(strpos($condition, '%s') !== false)
      {
        $argName = ':param'.$this->argNumber;
        $this->argNumber++;
        $pos = strpos($condition, '%s');
        $condition = substr($condition, 0, $pos) . $argName . substr($condition, $pos + 2);
        $namedValues[$argName] = array_shift($values);
      }
      while(preg_match('/\%.+?\%/', $condition, $matches))
      {
        $argName = ':param'.$this->argNumber;
        $this->argNumber++;
        $condition = str_replace($matches[0], $argName, $condition);
        $namedValues[$argName] = array_shift($values);
      }
      $values = $namedValues;
    }
    if($namedCondition)
    {
      $this->namedPatterns[$namedCondition] = $condition;
      if(empty($values))
      {
        $this->namedArgs[$namedCondition] = array();
      }
      else
      {
        foreach ($values as $key => $value)
        {
          $this->namedArgs[$namedCondition][$key] = $value;
        }
      }
    }
    else
    {
      // The operator of the first condition is ignored
      $comparison = $this->queryPattern ? $comparison : '';
      $this->queryPattern .= sprintf(' %s %s', $comparison, $condition);
      foreach ($values as $key => $value)
      {
        $this->queryArgs[$key] = $value;
      }
    }
    return $this;
  }
  
  /**
   * Combine named conditions into the main query or into a new named condition
   * Named conditions are to be defined in where()
   *
   * @param Array $conditions list of named conditions already set by way of where()
   * @param string $operator Combine operator ('and' or 'or')
   * @param string $namedCondition  If combined condition is to be stored for later combination (see combine())
   * 
   * @see where()
   * @return     sfDoctrineFinder the current finder object
   */
  public function combine($conditions, $operator = 'and', $namedCondition = null)
  {
    $addMethod = 'add'.ucfirst(strtolower(trim($operator)));
    if(!is_array($conditions))
    {
      $conditions = array($conditions);
    }
    
    $pattern = '(';
    $args = array();
    $isFirst = true;
    foreach($conditions as $condition)
    {
      if(!$isFirst)
      {
        $pattern .= ' ' . $operator . ' ';
      }
      $pattern .= $this->namedPatterns[$condition];
      $args = array_merge($args, $this->namedArgs[$condition]);
      unset($this->namedPatterns[$condition]);
      unset($this->namedArgs[$condition]);
      $isFirst = false;
    }
    $pattern .= ')';
    
    if($namedCondition)
    {
      $this->namedPatterns[$namedCondition] = $pattern;
      $this->namedArgs[$namedCondition] = $args;
    }
    else
    {
      $cond = $this->queryPattern ? 'and' : '';
      $this->queryPattern .= sprintf(' %s %s', $cond, $pattern);
      $this->queryArgs = array_merge($this->queryArgs, $args);
    }
    
    return $this;
  }
  
  /**
   * Finder fluid method to restrict results to a related object
   * Examples:
   *   $commentFinder->relatedTo($article)
   *
   * @param  Doctrine_Record $object The related object to restrict to
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function relatedTo($object)
  {
    $class = get_class($object);
    // Unfortunately we can't use the relation alias, so we must iterate over the relations to find the class
    // It will not work with multiple relations on the same table
    $relations = $this->object->getTable()->getRelations();
    foreach($relations as $relation)
    {
      if ($relation->getClass() == $class)
      {
        $foreign = $relation->getForeign();
        $this->addCondition('and', $this->getColName(sfInflector::camelize($relation->getLocal())), '=', $object->$foreign);
        
        return $this;
      }
    }
    
    throw new Exception('Could not find a relation with object of class '.$class);
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::orderby()
   * Infers $column and $order from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->orderBy('CreatedAt')
   *    => $query->orderBy('Article.created_at asc')
   *   $articlefinder->orderBy('CategoryId', 'desc')
   *    => $query->orderBy('Article.category_id desc')
   *
   * @param string $columnName The column to order by
   * @param string $order      The sorting order. 'asc' by default, also accepts 'desc'
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function orderBy($columnName, $order = 'asc')
  {
    $column = $this->getColName($columnName);
    if(!in_array(strtolower($order), array('asc', 'desc')))
    {
      throw new Exception('sfPropelFinder::orderBy() only accepts "asc" or "desc" as argument');
    }
    $this->query->orderby(sprintf('%s %s', $column, strtoupper($order)));
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::groupBy()
   * Infers $column and $order from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->groupBy('CreatedAt')
   *    => $query->groupBy('Article.created_at')
   *
   * @param string $columnName The column to group by
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function groupBy($columnName)
  {
    $column = $this->getColName($columnName);
    $this->query->addGroupBy($column);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::groupBy() but this times we add all columns from given class.
   * Examples:
   *   $articleFinder->groupBy('Article')
   *    => $query->groupBy('Article.id')->groupBy('Article.title')->groupBy('Article.created_at')
   * @param string $class
   *
   * @return sfDoctrineFinder the current finder object
   */
  public function groupByClass($class)
  {
    foreach (Doctrine::getTable($class)->getColumns() as $key => $details)
    {
      $column = $this->getColName($class.'.'.self::camelize($key));
      $this->query->addGroupBy($column);
    }
    
    return $this;
  }
  /**
   * Guess sort column based on their names
   * Will look primarily for columns named:
   * 'UpdatedAt', 'UpdatedOn', 'CreatedAt', 'CreatedOn', 'Id'
   * You can change this sequence by modifying the app_sfPropelFinder_sort_column_guesses value
   *
   * @param string $direction 'desc' (default) or 'asc'
   *
   * @return sfDoctrineFinder $this the current finder object
   */
  public function guessOrder($direction = 'desc')
  {
    $columnNames = self::camelize($this->getObject()->getTable()->getColumnNames());
    foreach(sfConfig::get('app_sfPropelFinder_sort_column_guesses', array('UpdatedAt', 'UpdatedOn', 'CreatedAt', 'CreatedOn', 'Id')) as $testColumnName)
    {
      if(in_array($testColumnName, $columnNames))
      {
        $this->orderBy($testColumnName, $direction);
        return $this;
      }
    }
    
    throw new Exception('Unable to figure out the column to use to order rows in sfDoctrineFinder::guessOrder()');
  }
  
  /**
   * Finder Fluid Interface for Doctrine_Query::join()
   * Infers $column1, $column2 and $operator from $relatedClass and some optional arguments
   * Uses table introspection to guess the related columns
   * Examples:
   *   $articleFinder->join('Comment')
   *   $articleFinder->join('Category', 'RIGHT JOIN')
   *   $articleFinder->join('Article.CategoryId', 'Category.Id', 'RIGHT JOIN')
   * 
   * @param  string $classOrColumn Class to join if 1 argument, first column of the join otherwise
   * @param  string $column Second column of the join if more than 1 argument
   * @param  string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
   *
   * @return     sfDoctrineFinder the current finder object
   */
  public function join()
  {
    $args = func_get_args();
    switch(count($args))
    {
      case 0:
        throw new Exception('sfDoctrineFinder::join() expects at least one argument');
        break;
      case 1:
      case 2:
        // $articleFinder->join('Comment')
        // $articleFinder->join('Comment co')
        // $articleFinder->join('Category', 'RIGHT JOIN')
        // $articleFinder->join('Category ca', 'RIGHT JOIN')
        list($relatedClass, $alias, $isTrueAlias) = $this->getClassAndAliasForDoctrine($args[0]);
        $relation = $this->findRelation($relatedClass);
        $operator = isset($args[1]) ? trim(str_replace('join', '', strtolower($args[1]))) : 'inner';
        $startClass = $this->getAlias($relation->offsetGet('localTable')->getClassnameToReturn());
        break;
      case 3:
        // $articleFinder->join('Article.CategoryId', 'Category.Id', 'RIGHT JOIN')
        // This is mostly for compatibility with Propel
        list($relation, $direct) = $this->findRelationFromColumns($args[0], $args[1]);
        $operator = trim(str_replace('join', '', strtolower($args[2])));
        $relatedClass = $relation->getTable()->getClassnameToReturn();
        if($direct)
        {
          $startClass = substr($args[0], 0, strpos($args[0], '.'));
        }
        else
        {
          $startClass = substr($args[1], 0, strpos($args[1], '.'));
        }
        $alias = '';
        break;
      case 4:
        // $articleFinder->join('Category cat', 'Article.CategoryId', 'cat.Id', 'RIGHT JOIN')
        // This is mostly for compatibility with Propel
        list($relatedClass, $alias) = $this->getClassAndAlias($args[0]);
        $col1 = str_replace($alias.'.', $relatedClass.'.', $args[1]);
        $col2 = str_replace($alias.'.', $relatedClass.'.', $args[2]);
        list($relation, $direct) = $this->findRelationFromColumns($col1, $col2);
        $operator = trim(str_replace('join', '', strtolower($args[3])));
        if($direct)
        {
          $startClass = substr($args[1], 0, strpos($args[1], '.'));
        }
        else
        {
          $startClass = substr($args[2], 0, strpos($args[2], '.'));
        }
    }
    $method = $operator . 'Join';
    $relationClass = $relation->getTable()->getClassnameToReturn();
    $this->query->$method($startClass.'.'.$relation->getAlias().' '.$alias);
    if($relationClass == $relatedClass)
    {
      $this->addAlias($relationClass, $alias);
    }
    else
    {
      // $relatedClass is in fact the relation name, not the foreign class name
      $this->addAlias($relatedClass, $alias);
    }
    
    return $this;
  }
  
  /**
   * Do no reinitialize the finder object after a termination method
   * By default the Doctrine_Query is wiped off whenever a termination method is called
   * Calling this method with true as parameter will keep the internal Query intact for the next termination method
   *
   * @param  Boolean $keep true (default) or false
   *
   * @return sfDoctrineFinder the current finder object
   */
  public function keepQuery($keep = true)
  {
    $this->reinit = !$keep;
    
    return $this;
  }
  
  /**
   * Returns a unique key for this finder conditions - necessary for caching
   *
   * @return string
   */
  public function getUniqueIdentifier()
  {
    $query = $this->getQueryObject();
    return md5(
      $query->getDQL().
      var_export($query->getParams(), true)
    );
  }
  
  /**
   * Enable or disable query caching
   */
  public function useCache($cacheInstance, $lifetime = 0)
  {
    if ($cacheInstance === true)
    {
      // Auto select process cache engine
      if (function_exists('apc_store'))
      {
        $cacher = 'Apc';
      }
      elseif (function_exists('xcache_set'))
      {
        $cacher = 'Xcache';
      }
      else
      {
        // No cache engine available; ignore gracefully
        return $this;
      }
      $cacheClass = 'Doctrine_Cache_' . $cacher;
      $cacheInstance = new $cacheClass;
    }
    $this->query->useQueryCache($cacheInstance, $lifetime = 0);
    $this->query->useResultCache($cacheInstance, $lifetime = 0);
    
    return $this;
  }
  
  /**
   * Returns the column type of one of the columns of the current model
   * 
   * @param string $name a CamelCase column name (e.g. CategoryId)
   *
   * @return string Any of the sfModelFinderColumn constants
   */
  public function getColumnType($name)
  {
    $column = $this->getColumnObject($name);
    
    return sfDoctrineFinderColumn::getColumnType($column);
  }
  
  /**
   * Returns a sfDoctrineColumn object filled with the information of a column of the current table
   *
   * @param string $name a CamelCase column name (e.g. CategoryId)
   *
   * @return sfDoctrineColumn a column object
   */
  public function getColumnObject($name)
  {
    $uName = self::underscore($name);
    if(!$this->object->getTable()->hasColumn($uName))
    {
      throw new Exception(sprintf('Class %s has no %s column', $this->class, $name));
    }
    
    if (class_exists('sfDoctrineAdminColumn'))
    {
      // Doctrine 1.0
      return new sfDoctrineAdminColumn($uName, $this->object->getTable()->getColumnDefinition($uName));
    }
    else
    {
      // Doctrine 1.1
      return new sfDoctrineColumn($uName, $this->object->getTable());
    }
  }
  
  protected function hasRelation($class)
  {
    return array_key_exists($class, $this->relations);
  }
  
  /**
   * Finds a relation between two classes by introspection
   *
   * @param string $class Doctrine_Record Class name (e.g. 'Article')
   * 
   * @return Relation A Doctrine relation object
   */
  public function findRelation($class)
  {
    if($this->hasRelation($class))
    {
      return $this->relation[$class];
    }
    foreach($this->relatedTables as $relationAlias => $table)
    {
      foreach ($table->getRelations() as $key => $relation)
      {
        if ($relation->getClass() == $class)
        {
          $this->relatedTables[$key]= Doctrine::getTable($class);
          $this->relations[$class] = $relation;
          $this->relationPath[$key] = $this->relationPath[$relationAlias] . '.' . $key;
          
          return $relation;
        }
      }
    }
    // You never know... try the relation alias rather than die
    foreach($this->relatedTables as $relationAlias => $table)
    {
      if($table->hasRelation($class))
      {
        $relation = $table->getRelation($class);
        $this->relatedTables[$relation->getAlias()]= $relation->getTable();
        $this->relations[$class] = $relation;
        
        return $relation;
      }
    }
    
    throw new Exception(sprintf('Cannot determine relation to class %s', $class));
  }
  
  public function findRelationFromColumns($col1, $col2)
  {
    list($leftClass, $leftColumn, $leftAlias) = $this->getColName($col1, $class = null, $detail = true, $autoAddJoin = false);
    list($rightClass, $rightColumn, $rightAlias) = $this->getColName($col2, $class = null, $detail = true, $autoAddJoin = false);
    
    foreach($this->relatedTables as $table)
    {
      foreach ($table->getRelations() as $key => $relation)
      {
        if ($relation->getClass() == $rightClass && $relation->getForeign() == $rightColumn && 
            $relation->offsetGet('localTable')->getClassnameToReturn() == $leftClass && $relation->getLocal() == $leftColumn)
        {
          $this->relatedTables[]= Doctrine::getTable($rightClass);
          $this->relations[$rightClass] = $relation;
          
          return array($relation, true);
        }
        if ($relation->getClass() == $leftClass && $relation->getForeign() == $leftColumn && 
            $relation->offsetGet('localTable')->getClassnameToReturn() == $rightClass && $relation->getLocal() == $rightColumn)
        {
          $this->relatedTables[]= Doctrine::getTable($leftClass);
          $this->relations[$leftClass] = $relation;
          
          return array($relation, false);
        }

      }
    }
    
    throw new Exception(sprintf('Cannot determine relation between %s and %s', $col1, $col2));
  }
  
  protected function getClassAndAliasForDoctrine($class)
  {
    if(strpos($class, ' ') !== false)
    {
      // true alias given by user
      list($class, $alias) = explode(' ', $class);
      return array($class, $alias, true);
    }
    else
    {
      // no alias, computing one
      $alias = strtolower(substr($class, 0, 1));
      while(array_key_exists($alias, $this->aliases))
      {
        $alias .= '1';
      }
      return array($class, $alias, false);
    }
  }
  
  protected function getColName($phpName, $class = null, $detail = false, $autoAddJoin = true)
  {
    if(array_key_exists($phpName, $this->withColumns))
    {
      return $phpName;
    }
    if(strpos($phpName, '.') !== false)
    {
      // Table.Column
      list($class, $phpName) = explode('.', $phpName);
    }
    else if(strpos($phpName, '_') !== false)
    {
      // Table_Column, or Table_Name_Column, so explode is not a solution here
      $limit = strrpos($phpName, '_');
      $class = substr($phpName, 0, $limit);
      $phpName = substr($phpName, $limit + 1);
    }
    else
    {
      // Column
      if(!$class)
      {
        $class = $this->getClass();
      }
    }
    
    // class may be an alias
    if($this->isAlias($class))
    {
      $alias = $class;
      $class = $this->getClassFromAlias($alias);
    }
    else
    {
      // class may have an alias
      $alias = $this->getAlias($class);
    }
    
    // Auto guess join
    if($class != $this->class && !$this->hasRelation($class) && $autoAddJoin)
    {
      $this->join($class);
      $alias = $this->getAlias($class);
    }
    
    $colName = $alias . '.' . self::underscore($phpName);
    
    return $detail ? array($class, self::underscore($phpName), $alias) : $alias . '.' . self::underscore($phpName);
  }
  
  public function debug()
  {
    echo "** Debugging Doctrine Query\n";
    $this->limit(1);
    echo "   " . $this->getQueryObject()->getDQL()."\n";
    $this->findOne();
    echo "   " . $this->getLatestQuery()."\n";
  }
  
  public function __sleep()
  {
    $attributes = get_object_vars($this);
    unset($attributes['object']);
    unset($attributes['query']);
    return array_keys($attributes);
  }
  
}