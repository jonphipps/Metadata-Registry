<?php

class pkZendSearch
{
  // Returns just the IDs. See below for a better method to use if you're
  // pulling the actual objects from Doctrine
  
  static public function searchLucene(Doctrine_Table $table, $luceneQuery, $culture = null)
  {
    if (!is_null($culture))
    {
      $culture = self::normalizeCulture($culture);
      $query .= " +culture:$culture";
    }
    $index = $table->getLuceneIndex();
    
    $hits = $index->find($luceneQuery);
   
    $ids = array();
    foreach ($hits as $hit)
    {
      $ids[] = $hit->pk;
    }
    return $ids;
  }
  
  static public function addSearchQuery(Doctrine_Table $table, Doctrine_Query $q = null, $luceneQuery, $culture = null)
  {
    $name = $table->getOption('name');

    if (is_null($q))
    {
      $q = Doctrine_Query::create()
        ->from($name);
    }
    
    $results = $table->searchLucene($luceneQuery, $culture);
    
    if (count($results))
    {
      $alias = $q->getRootAlias();
      // Contrary to Jobeet the above is NOT enough, the results will
      // not be in Lucene result order without what is usually referred
      // to as ORDER BY FIELD. Doctrine doesn't like FIELD in an
      // ORDER BY clause. However FIELD turns out to be a perfectly
      // ordinary MySQL function so you can put it in a SELECT alias
      // and then ORDER BY the alias (thanks John Wage).

      // Call addSelect so that we don't trash existing queries.
      $q->addSelect($alias.'.*, ' .
        'FIELD('.$alias.'.id, ' . implode(", ", $results) . ') AS field');
      $q->whereIn($alias.'.id', $results);
      $q->orderBy("field");
    }
    else
    {
      // Don't just let everything through when there are no hits!
      $q->andWhere('false');
    }
    
    return $q;
  }

  static public function purgeLuceneIndex(Doctrine_Table $table)
  {
    $file = $table->getLuceneIndexFile();

    if (file_exists($file))
    {
      sfToolkit::clearDirectory($file);
      rmdir($file);
    }
  }

  static public function rebuildLuceneIndex(Doctrine_Table $table)
  {
    self::purgeLuceneIndex($table);
    $index = $table->getLuceneIndex();
    
    // TODO: hydrate these one at a time once Doctrine supports
    // doing that efficiently
    $all = $table->findAll();
    foreach ($all as $item)
    {
      $item->updateLuceneIndex();
    }

    return $table->optimizeLuceneIndex();
  }
  
  static public function optimizeLuceneIndex(Doctrine_Table $table)
  {
    $index = $table->getLuceneIndex();

    return $index->optimize();
  }

  // If you're storing different search text for different cultures, but
  // at delete time you want to trash ALL the cultures for this object,
  // that's fine: just don't pass a culture to delete. That's appropriate
  // if, for instance, you are deleting a page from a CMS entirely, all
  // localizations included.

  // If you do pass a culture this method will remove the object from the
  // potential search results for that particular culture.

  static public function deleteFromLuceneIndex(Doctrine_Record $object, $culture = null)
  {
    $index = $object->getTable()->getLuceneIndex();
   
    // remove an existing entry
    $id = $object->getId();
    if (!is_null($culture))
    {
      $culture = self::normalizeCulture($culture);
      $query = "+pk:$id +culture:$culture";
    }
    else
    {
      $query = "pk:$id";
    }
    if ($hit = $index->find($query))
    {
      // id is correct. This is the internal Zend search index id which is
      // not the same thing as the id of our object.
      $index->delete($hit->id);
    }
  }

  // You can use this directly, but also see below for a wrapper that 
  // saves in both doctrine and Zend, wrapping the whole thing
  // in a Doctrine transaction and rolling back on any Lucene exceptions.

  static public function updateLuceneIndex(Doctrine_Record $object, $fields = array(), $culture = null)
  {
    self::deleteFromLuceneIndex($object, $culture);
    $index = self::getLuceneIndex($object->getTable());
    $doc = new Zend_Search_Lucene_Document();
   
    // store item id so we can retrieve the corresponding object
    $doc->addField(Zend_Search_Lucene_Field::UnIndexed('pk', $object->getId()));
    if (!is_null($culture))
    {
      $doc->addField(Zend_Search_Lucene_Field::Keyword('culture', $culture));
    }
    // index the fields
    foreach ($fields as $key => $value)
    {
      $doc->addField(Zend_Search_Lucene_Field::UnStored($key, $value, 'utf-8'));
    }
   
    // add item to the index
    $index->addDocument($doc);
    $index->commit();
  }

  // This does a clean job of saving the object in both doctrine and zend
  // without a lot of duplicated code, reducing the potential for
  // bugs. However if you use it your class must implement 
  // doctrineSave($conn), which is usually just a trivial wrapper around
  // a call to parent::save($conn). 

  // "What if I need to save additional related objects to some other
  // table as part of the save() operation for this object, and I want
  // that to be part of the transaction?" Do those things in 
  // your doctrineSave() method.

  static public function saveInDoctrineAndLucene($object, $culture = null, Doctrine_Connection $conn = null)
  {
    $conn = $conn ? $conn : $object->getTable()->getConnection();
    $conn->beginTransaction();
    try
    {
      $ret = $object->doctrineSave($conn);
      $object->updateLuceneIndex($culture);
      $conn->commit();
      return $ret;
    }
    catch (Exception $e)
    {
      $conn->rollBack();
      throw $e;
    }
  }

  // This does a clean job of deleting the object from both doctrine and 
  // zend without a lot of duplicated code, reducing the potential for
  // bugs. However if you use it your class must implement 
  // doctrineDelete($conn), which is a trivial wrapper around
  // a call to parent::delete($conn) (unless you need to delete
  // additional related objects from some other table perhaps, in
  // which case you should do that work in doctrineDelete too).

  static public function deleteFromDoctrineAndLucene($object, $culture = null, Doctrine_Connection $conn = null)
  {
    $conn = $conn ? $conn : $object->getTable()->getConnection();
    $conn->beginTransaction();
    try
    {
      $ret = $object->doctrineDelete($conn);
      pkZendSearch::deleteFromLuceneIndex($object, $culture); 
      $conn->commit();
      return $ret;
    } 
    catch (Exception $e)
    {
      $conn->rollBack();
      throw $e;
    }
  }

  // Implementation details

  static protected $zendLoaded = false;
  static public function registerZend()
  {
    if (self::$zendLoaded)
    {
      return;
    }

    require_once 'Zend/Loader.php';
    Zend_Loader::registerAutoload();
    self::$zendLoaded = true;
  }

  static public function getLuceneIndex(Doctrine_Table $table)
  {
    self::registerZend();
   
    if (file_exists($index = $table->getLuceneIndexFile()))
    {
      return Zend_Search_Lucene::open($index);
    }
    else
    {
      // Since we're using a subdir for all zend indexes to keep things
      // neat, we might need to make that subdir
      $parent = dirname($index);
      if (!file_exists($parent))
      {
        mkdir($parent);
      }
      
      return Zend_Search_Lucene::create($index);
    }
  }
   
  static public function getLuceneIndexFile(Doctrine_Table $table)
  {
    return sfConfig::get('sf_data_dir').'/zendIndexes/'.$table->getOption('name').'.'.sfConfig::get('sf_environment').'.index';
  }

  static public function normalizeCulture($culture)
  {
    if (!strlen($culture))
    {
      $culture = sfConfig::get('sf_default_culture', 'en');
    }
  }
}

?>
