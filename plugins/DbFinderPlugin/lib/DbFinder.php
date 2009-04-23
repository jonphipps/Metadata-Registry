<?php

/*
 * This file is part of the DbFinder package.
 * 
 * (c) 2007 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * DbFinder is an ORM compatibility layer working with both Propel and Doctrine
 * Use it just like sfPropelFinder or sfDoctrineFinder
 * According to the type of class used to initialize it (BaseObject or Doctrine_Record),
 * It will initialize an adapter to sfPropelFinder or sfDoctrineFinder
 * And handle all method calls to this adapter
 */
class DbFinder extends sfModelFinder
{
  protected
    $adapter = null,
    $type = null;
    
  public function __construct($adapter = '')
  {
    if(!$adapter)
    {
      // using $this->class as a fallback
      if(class_exists($class = $this->class))
      {
        list($adapterClass, $type) = DbFinderAdapterUtils::getParams($class);
        $this->adapter = new $adapterClass($class);
        $this->type = $type;
      }
    }
    else if($adapter instanceof sfModelFinder)
    {
      $this->adapter = $adapter;
      $this->type = DbFinderAdapterUtils::getType($adapter);
    }
    else
    {
      throw new Exception('DbFinder constructor expects a sfModelFinder instance');
    }
    
    $this->initialize();
  }
  
  /**
   * Empty initialization method, to allow extensibility
   */
  public function initialize() {}
  
  public function getAdapter()
  {
    return $this->adapter;
  }
  
  public function getType()
  {
    return $this->type;
  }
  
  // Finder Initializers

  /**
   * Mixed initializer
   * Accepts either a string (Model object class) or an array of model objects
   *
   * @param mixed $from The data to initialize the finder with
   * @param mixed $connection Optional connection object
   *
   * @return DbFinder a finder object
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
    throw new Exception('DbFinder::from() only accepts a model object classname or an array of model objects');
  }
  
  /**
   * Array initializer
   *
   * @param array $array Array of Primary keys
   * @param string $class Model classname on which the search will be done
   *
   * @return DbFinder a finder object
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
   * @return DbFinder a finder object
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
    if(class_exists($finderClass = $realClass.'Finder'))
    {
      $tmp = new $finderClass;
      if($tmp instanceof sfModelFinder)
      {
        $finder = $tmp;
        if($connection)
        {
          $finder->setConnection($connection);
        }
        
        return $finder;
      }
      else
      {
        throw new Exception('DbFinder::fromClass() only accepts a model object or a finder classname');
      }
    }
    else if(class_exists($realClass))
    {
      list($adapterClass) = DbFinderAdapterUtils::getParams($realClass);
      $finder = new $adapterClass($class, $connection);
    }
    else
    {
      throw new Exception('DbFinder::fromClass() only accepts a model object or a finder classname');
    }
    
    $me = __CLASS__;
    $dbFinder = new $me($finder);

    return $dbFinder;
  }
  
  /**
   * Collection initializer
   *
   * @param array $from Array of model objects of the same class
   * @param string $class Optional classname of the desired objects
   * @param string $class Optional column name of the primary key
   *
   * @return DbFinder a finder object
   * @throws Exception If the array is empty, contains not model objects or composite objects
   */
  public static function fromCollection($collection, $class = '', $pkName = '')
  {
    if(count($collection) == 0)
    {
      if(!$class)
      {
        throw new Exception('A DbFinder cannot be initialized with an empty array and no class');
      }
      else
      {
        return self::fromClass($class);
      }
    }
    
    $testObject = $collection[0];
    list($adapterClass) = DbFinderAdapterUtils::getParams($collection[0]);
    $finder = call_user_func(array($adapterClass, 'fromCollection'), $collection, $class, $pkName);
    
    if(class_exists($finderClass = get_class($testObject).'Finder'))
    {
      $dbFinder = new $finderClass();
      $dbFinder->setQueryObject($finder->getQueryObject());
    }
    else
    {
      $me = __CLASS__;
      $dbFinder = new $me($finder);
    }

    return $dbFinder;
  }
  
  // Finder accessors
  
  public function getClass()
  {
    return $this->adapter->getClass();
  }
  
  public function setClass($class, $alias = '')
  {
    $this->adapter->setClass($class, $alias);
    
    return $this;
  }
  
  public function getConnection()
  {
    return $this->adapter->getConnection();
  }
  
  public function setConnection($connection)
  {
    $this->adapter->getsetConnection($connection);
    
    return $this;
  }
  
  /**
   * Returns the internal query object
   *
   * @return mixed A query object, depending on the adapter (Criteria or Doctrine_Query)
   */
  public function getQueryObject()
  {
    return $this->adapter->getQueryObject();
  }
  
  /**
   * Replaces the internal query object
   *
   * @return DbFinder The current finder
   */
  public function setQueryObject($query)
  {
    $this->adapter->setQueryObject($query);
    
    return $this;
  }
  
  /**
   * Makes the finder return a scalar instead of an object
   * Examples:
   *   DbFinder::from('Article')->select('Name')->find();
   *   => array('Foo', 'Bar')
   *   DbFinder::from('Article')->select('Name')->findOne();
   *   => 'Foo'
   *   DbFinder::from('Article')->select(array('Id', 'Name'))->find();
   *   => array(
   *        array('Id' => 1, 'Name' => 'Foo'),
   *        array('Id' => 2, 'Name' => 'Bar')
   *      )
   *   DbFinder::from('Article')->select(array('Id', 'Name'), sfModelFinder::SIMPLE)->find();
   *   => array(
   *        array(1, 'Foo'),
   *        array(2, 'Bar')
   *      )
   *   DbFinder::from('Article')->select(array('Id', 'Name'))->findOne();
   *   => array('Id' => 1, 'Name' => 'Foo')
   *   DbFinder::from('Article')->select(array('Id', 'Name'), sfModelFinder::SIMPLE)->findOne();
   *   => array(1, 'Foo')
   *
   * @param mixed $columnArray A list of column names (e.g. array('Title', 'Category.Name', 'c.Content')) or a single column name (e.g. 'Name')
   * @param string $keyType Either sfModelFinder::ASSOCIATIVE or sfModelFinder::SIMPLE. In the latter case, the finder result sets uses numeric index.
   *
   * @return     DbFinder the current finder object
   */
  public function select($columnArray, $keyType = self::ASSOCIATIVE)
  {
    return $this->adapter->select($columnArray, $keyType);
  }
  
  // Finder executers
  
  /**
   * Returns the number of records matching the finder
   *
   * @param Boolean $distinct Whether the count query has to add a DISTINCT keyword
   *
   * @return integer Number of records matching the finder
   */
  public function count($distinct = false)
  {
    return $this->adapter->count($distinct);
  }
  
  /**
   * Executes the finder and returns the matching Model objects
   *
   * @param integer $limit Optional maximum number of results to retrieve
   *
   * @return array A list of Model objects
   */
  public function find($limit = null)
  {
    return $this->adapter->find($limit);
  }
  
  /**
   * Limits the search to a single result, and executes the finder
   * Returns the first model object matching the finder
   *
   * @return mixed a model object or null
   */
  public function findOne()
  {
    return $this->adapter->findOne();
  }
  
  /**
   * Returns the last record matching the finder
   * Optionally, you can specify the column to sort on
   * If no column is passed, the finder guesses the column to use
   * @see guessOrder()
   *
   * @param string $columnName Optional: The column to order by
   *
   * @return mixed a model object or null
   */
  public function findLast($column = null)
  {
    return $this->adapter->findLast($column);
  }
  
  /**
   * Returns the first record matching the finder
   * Optionally, you can specify the column to sort on
   * If no column is passed, the finder guesses the column to use
   * @see guessOrder()
   *
   * @param string $columnName Optional: The column to order by
   *
   * @return mixed a model object or null
   */
  public function findFirst($column = null)
  {
    return $this->adapter->findFirst($column);
  }
  
  /**
   * Adds a condition on a column and returns the records matching the finder
   *
   * @param string $columnName Name of the columns
   * @param mixed $value
   * @param integer $limit Optional maximum number of records to return
   *
   * @return array A list of model objects
   */
  public function findBy($columnName, $value, $limit = null)
  {
    return $this->adapter->findBy($columnName, $value, $limit);
  }
  
  /**
   * Adds a condition on a column and returns the first record matching the finder
   * Useful to retrieve objects by a column which is not the primary key
   *
   * @param string $columnName Name of the columns
   * @param mixed $value
   *
   * @return mixed a model object or null
   */
  public function findOneBy($columnName, $value)
  {
    return $this->adapter->findOneBy($columnName, $value);
  }
  
  /**
   * Finds record(s) based on one or several primary keys
   * Takes into account hydrating methods previously called on the finder
   *
   * @param mixed $pk A primary kay, a composite primary key, or an array of primary keys
   *
   * @return mixed One or several model records (based on the input)
   */
  public function findPk($pk)
  {
    $pk = func_get_args();
    return call_user_func_array(array($this->adapter, 'findPk'), $pk);
  }
  
  /**
   * Deletes the records found by the finder
   * Beware that behaviors based on hooks in the object's delete() method (such as sfPropelParanoidBehavior)
   * Will only be triggered if you force individual deletes, i.e. if you pass true as first argument
   *
   * @param Boolean $forceIndividualDeletes If false (default), all deletes are done in a single query, ortherwise it is a series of delete() calls on all the found objects
   *
   * @return Integer Number of deleted rows
   */
  public function delete($forceIndividualDeletes = false)
  {
    return $this->adapter->delete($forceIndividualDeletes);
  }
  
  /**
   * Prepares a pager based on the finder
   * The pager is initialized (it knows how many pages it contains)
   * But it won't be populated until you call getResults() on it
   *
   * @param integer $page The current page (1 by default)
   * @param integer $maxPerPage The maximum number of results per page (10 by default)
   *
   * @return mixed The initialized pager object (sfPropelFinderPager or sfDoctrineFinderPager)
   */
  public function paginate($page = 1, $maxPerPage = 10)
  {
    return $this->adapter->paginate($page, $maxPerPage);
  }
  
  /**
   * Updates the records found by the finder
   * Beware that behaviors based on hooks in the object's save() method
   * Will only be triggered if you force individual saves, i.e. if you pass true as second argument
   *
   * @param Array $values Associative array of keys and values to replace
   * @param Boolean $forceIndividualSaves If false (default), all updates are done in a single query, ortherwise it is a series of save() calls on all the found objects
   *
   * @return Integer Number of deleted rows
   */
  public function set($values, $forceIndividualSaves = false)
  {
    return $this->adapter->set($values, $forceIndividualSaves);
  }

  // Hydrating
  
  /**
   * Ask the finder to hydrate related records
   * Examples:
   *   // Article has an author, article has a category, and author has a group
   *   $articleFinder->with('Author')->find();
   *   $articleFinder->with('Author', 'Category')->find();
   *   $articleFinder->with('Author', 'Group')->find();
   *   $articleFinder->join('Author')->with('Group')->find();
   *   // By default, the finder uses a simple join (where) but you can force another join
   *   $articleFinder->leftJoin('Author')->with('Author')->find();
   *
   * @return     DbFinder the current finder object
   */
  public function with($classes)
  {
    if(!is_array($classes))
    {
      $classes = func_get_args();
    }
    $this->adapter->with($classes);
    
    return $this;
  }
  
  /**
   * Ask the finder to hydrate related i18n records
   *
   * @param string $culture Optional culture value. If no culture is given, the current user's culture is used
   *
   * @return     DbFinder the current finder object
   */
  public function withI18n($culture = null)
  {
    $this->adapter->withI18n($culture);
    
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
   *   // Support for calculated columns with native database column names
   *   $articles = articleFinder->
   *     join('Comment')->
   *     withColumn('COUNT(comment.ID)', 'NbComments')->
   *     groupBy('Article.Id')->
   *     find();
   *
   *   // Support for calculated columns with DbFinder-style column names
   *   // Warning: only works if
   *   //  - the column names include the class name, e.g. 'Comment.Id', not 'Id' alone
   *   //  - the column names are inside parenthesis, e.g. '(Comment.Id + Article.Id)', not 'Comment.Id + Article.Id'
   *   $articles = articleFinder->
   *     join('Comment')->
   *     withColumn('COUNT(Comment.Id)', 'NbComments')->
   *     groupBy('Article.Id')->
   *     find();
   *
   * @param string $column The column to add. Can be a calculated column
   * @param string $alias Optional alias for column retrieval
   * @param string $type Optional type converter to be sure the retrieved column has the correct type
   *
   * @return     DbFinder the current finder object
   */
  public function withColumn($column, $alias = null, $type = null)
  {
    $this->adapter->withColumn($column, $alias, $type);
    
    return $this;
  }
  
  // Finder Filters
  
  /**
   * Finder Fluid Interface for SQL DISTINCT
   *
   * @return     DbFinder the current finder object
   */
  public function distinct()
  {
    $this->adapter->distinct();
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for SQL LIMIT
   *
   * @return     DbFinder the current finder object
   */
  public function limit($limit)
  {
    $this->adapter->limit($limit);
    
    return $this;
  }

  /**
   * Finder Fluid Interface for SQL OFFSET
   *
   * @return     DbFinder the current finder object
   */
  public function offset($offset)
  {
    $this->adapter->offset($offset);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for SQL WHERE
   * Infers $column, $value, $comparison from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->where('IsPublished')
   *    => WHERE article.IS_PUBLISHED = true
   *   $articleFinder->where('CommentId', 3)
   *    => WHERE article.COMMENT_ID = 3
   *   $articleFinder->where('Title', 'like', '%foo')
   *    => WHERE article.TITLE LIKE '%foo'
   *   $articleFinder->where('Title', 'like', '%foo', 'FooTitle')
   *    => WHERE (article.TITLE LIKE '%foo')
   *
   * @param      string  $columnName PHPName of the column bearing the condition
   * @param      string  $valueOrOperator  Value if 2 arguments, operator otherwise
   * @param      string  $value  Value if 3 arguments (optional)
   * @param      string  $namedCondition  If condition is to be stored for later combination (see combine())
   *
   * @return     DbFinder the current finder object
   */
  public function where()
  {
    $args = func_get_args();
    call_user_func_array(array($this->adapter, 'where'), $args);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for OR in a WHERE
   * Infers $column, $value, $comparison from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->orWhere('CommentId', 3)
   *    => WHERE ... OR article.COMMENT_ID = 3
   *   $articleFinder->orWhere('Title', 'like', '%foo')
   *    => WHERE ... OR article.TITLE LIKE '%foo'
   *
   * @param      string  $columnName PHPName of the column bearing the condition
   * @param      string  $valueOrOperator  Value if 2 arguments, operator otherwise
   * @param      string  $value  Value if 3 arguments (optional)
   *
   * @return     DbFinder the current finder object
   */
  public function orWhere()
  {
    $args = func_get_args();
    call_user_func_array(array($this->adapter, 'orWhere'), $args);
    
    return $this;
  }
  
  /**
   * Allow for a custom condition and takes care of parameter escaping
   * Examples:
   *   $articleFinder->whereCustom('UPPER(Article.Title) = ?', $title)
   *    =>  WHERE UPPER(article.TITLE) = '[escaped $title]';
   *   $articleFinder->whereCustom('CONCAT(Article.Title, ?) = ?, array('foo', $title));
   *    =>  WHERE CONCAT(article.TITLE, 'foo') = '[escaped $title]';
   *    $articleFinder->whereCustom('UPPER(Article.Title) = %foo%', array('%foo%' => $title))
   *    =>  WHERE UPPER(article.TITLE) = '[escaped $title]';
   *
   * @param      string  $condition SQL clause containing at least the complete name of a column
   * @param      mixed  $values Array of values to be escaped and replaced in the clause
   * @param      string  $namedCondition  If condition is to be stored for later combination (see combine())
   *
   * @return     sfPropelFinder the current finder object
   */
  public function whereCustom($condition, $values = array(), $namedCondition = null)
  {
    $this->adapter->whereCustom($condition, $values, $namedCondition);
    
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
   * @return     sfPropelFinder the current finder object
   */
  public function orWhereCustom($condition, $values = array())
  {
    $this->adapter->orWhereCustom($condition, $values);
    
    return $this;
  }
  
  /**
   * Combine named conditions into the main criteria or into a new named condition
   * Named conditions are to be defined in where()
   *
   * @param Array $conditions list of named conditions already set by way of where()
   * @param string $operator Combine operator ('and' or 'or')
   * @param string $namedCondition  If combined condition is to be stored for later combination
   * 
   * @see where()
   * @return     DbFinder the current finder object
   */
  public function combine($conditions, $operator = 'and', $namedCondition = null)
  {
    $this->adapter->combine($conditions, $operator, $namedCondition);
    
    return $this;
  }
  
  /**
   * Finder fluid method to restrict results to a related object
   * Examples:
   *   $commentFinder->relatedTo($article)
   *    => 'WHERE comment.ARTICLE_ID = '.$article->getId()
   *
   * @param  mixed $object The related model object to restrict to
   * @return DbFinder the current finder object
   */
  public function relatedTo($object)
  {
    $this->adapter->relatedTo($object);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for SQL ORDER BY
   * Infers $column and $order from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->orderBy('CreatedAt')
   *    => ORDER BY article.CREATED_AT ASC
   *   $articlefinder->orderBy('CategoryId', 'desc')
   *    => ORDER BY article.CATEGORY_ID DESC
   *
   * @param  string $columnName The column to order by
   * @param  string $order      The sorting order. 'asc' by default, also accepts 'desc'
   *
   * @return DbFinder the current finder object
   */
  public function orderBy($columnName, $order = 'asc')
  {
    $this->adapter->orderBy($columnName, $order);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for SQL GROUP BY
   * Infers $column and $order from $columnName and some optional arguments
   * Examples:
   *   $articleFinder->groupBy('CreatedAt')
   *    => GROUP BY article.CREATED_AT
   *
   * @param  string $columnName The column to group by
   *
   * @return DbFinder the current finder object
   */
  public function groupBy($columnName)
  {
    $this->adapter->groupBy($columnName);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for SQL GROUP BY but this times we add all columns from given class.
   * Examples:
   *   $articleFinder->groupBy('Article')
   *    => GROUP BY article.ID, article.TITLE, article.CREATED_AT... 
   * @param  string $class
   *
   * @return DbFinder the current finder object
   */
  public function groupByClass($class)
  {
    $this->adapter->groupByClass($class);
    
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
   * @return DbFinder the current finder object
   */
  public function guessOrder($direction = 'desc')
  {
    $this->adapter->guessOrder($direction);
    
    return $this;
  }
  
  /**
   * Finder Fluid Interface for SQL JOIN
   * Infers $column1, $column2 and $operator from $relatedClass and some optional arguments
   * Uses the Propel column maps, based on the schema, to guess the related columns
   * Examples:
   *   $articleFinder->join('Comment')
   *    => WHERE article.ID = comment.ARTICLE_ID
   *   $articleFinder->join('Category', 'RIGHT JOIN')
   *    => RIGHT JOIN category ON article.CATEGORY_ID = category.ID
   *   $articleFinder->join('Article.CategoryId', 'Category.Id', 'RIGHT JOIN')
   *    => RIGHT JOIN category ON article.CATEGORY_ID = category.ID
   * 
   * @param  string $classOrColumn Class to join if 1 argument, first column of the join otherwise
   * @param  string $column Second column of the join if more than 1 argument
   * @param  string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
   *
   * @return DFinder the current finder object
   */
  public function join()
  {
    $args = func_get_args();
    call_user_func_array(array($this->adapter, 'join'), $args);
    
    return $this;
  }
  
  // Finder utilities
  
  /**
   * Do no reinitialize the finder object after a termination method
   *
   * @param  Boolean $keep true (default) or false
   *
   * @return DbFinder the current finder object
   */
  public function keepQuery($keep = true)
  {
    $this->adapter->keepQuery($keep);
    
    return $this;
  }
  
  /**
   * Returns the SQL for the latest executed query
   * Only works in debug mode
   *
   * @return string Latest SQL query
   */
  public function getLatestQuery()
  {
    return $this->adapter->getLatestQuery();
  }
  
  /**
   * Cleans up the query object (if necessary) and logs the latest query
   *
   * @return DbFinder the current finder object
   */
  protected function cleanup()
  {
    $this->adapter->cleanup();
    
    return $this;
  }
  
  /**
   * Returns a unique key for this finder conditions - necessary for caching
   *
   * @return string
   */
  public function getUniqueIdentifier()
  {
    return $this->adapter->getUniqueIdentifier();
  }
  
  /**
   * Enable or disable query caching
   */
  public function useCache($cacheInstance, $lifetime = 0)
  {
    $this->adapter->useCache($cacheInstance, $lifetime);
    
    return $this;
  }
  
  public function getColumnType($name)
  {
    return $this->adapter->getColumnType($name);
  }
  
}