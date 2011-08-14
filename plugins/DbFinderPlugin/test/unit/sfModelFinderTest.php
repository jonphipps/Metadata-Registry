<?php
/*
 * This file is part of the DbFinder package.
 * 
 * (c) 2007 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
You need a model built with a running database to run these tests.
The tests expect a model similar to this one:

    # Propel model
    propel:
      article:
        id:          ~
        title:       varchar(255)
        category_id: ~

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../bootstrap.php';

$con = Propel::getConnection();

$t = new lime_test(18, new lime_output_color());

class testFinder extends sfModelFinder
{
  protected $test = false;

  public function test()
  {
    $this->test = true;
    
    return $this;
  }
  
  public function dummy()
  {
    return $this;
  }
  
  public function getTest()
  {
    return $this->test;
  }
  
  // Finder accessors
  
  public function getClass() {}
  public function setClass($class, $alias = '') {}
  public function getConnection() {}
  public function setConnection($connection) {}
  public function getQueryObject() {}
  public function setQueryObject($query) {}
  
  // Finder output
  
  public function select($columnArray, $keyType = self::ASSOCIATIVE) {}
  
  // Finder executers
  
  public function count($distinct = false) {}
  public function find($limit = null) {}
  public function findOne() {}
  public function findLast($column = null) {}
  public function findFirst($column = null) {}
  public function findBy($columnName, $value, $limit = null) {}
  public function findOneBy($columnName, $value) {}
  public function findPk($pk) {}
  public function delete($forceIndividualDeletes = false) {}
  public function paginate($page = 1, $maxPerPage = 10) {}
  public function set($values, $forceIndividualSaves = false) {}

  // Hydrating
  
  public function with($classes) {}
  public function withI18n($culture = null) {}
  public function withColumn($column, $alias = null, $type = null) {}
  
  // Finder Filters
  
  public function distinct() {}
  public function limit($limit) {}
  public function offset($offset) {}
  public function where() { }
  public function orWhere() {}
  public function combine($conditions, $operator = 'and', $namedCondition = null) {}
  public function whereCustom($condition, $values = array(), $namedCondition = null) {}
  public function orWhereCustom($condition, $values = array()) {}
  public function relatedTo($object) {}
  public function orderBy($columnName, $order = null) {}
  public function groupBy($columnName) {}
  public function groupByClass($class) {}
  public function guessOrder($direction = 'desc') {}
  public function join() {}
  
  // Finder utilities
  
  public function keepQuery($keep = true) {}
  public function getLatestQuery() {}
  protected function cleanup() {}
  public function getUniqueIdentifier() {}
  public function useCache($cacheInstance, $lifetime = 0) {}
  
  public function getColumnType($name) {}
}

$t->diag('_if()');

$f = new testFinder('Article');
$f->
  _if(true)->
    test()->
  _endif();
$t->is($f->getTest(), true, '_if() executes the next method if the test is true');
$f = new testFinder('Article');
$f->
  _if(false)->
    test()->
  _endif();
$t->is($f->getTest(), false, '_if() does not execute the next method if the test is false');
$f = new testFinder('Article');
$f->
  _if(false)->
    foo()->
  _endif();
$t->is($f->getTest(), false, '_if() does not check the existence of the next method if the test is false');
$f = new testFinder('Article');
$f->
  _if(true)->
    dummy()->
    test()->
  _endif();
$t->is($f->getTest(), true, '_if() executes the next methods until _endif() if the test is true');
$f = new testFinder('Article');
$f->
  _if(false)->
    dummy()->
    test()->
  _endif();
$t->is($f->getTest(), false, '_if() does not execute the next methods until _endif() if the test is false');
$f = new testFinder('Article');
try
{
  $f->
    _if(false)->
    _if(true)->
      test()->
    _endif();
  $t->fail('_if() statements cannot be nested');
}
catch (Exception $e)
{
  $t->pass('_if() statements cannot be nested');
}

$t->diag('_elseif()');

$f = new testFinder('Article');
$f->
  _if(true)->
  _elseif(true)->
    test()->
  _endif();
$t->is($f->getTest(), false, '_elseif() does not execute the next method if the main test is true');
$f = new testFinder('Article');
$f->
  _if(true)->
  _elseif(false)->
    test()->
  _endif();
$t->is($f->getTest(), false, '_elseif() does not execute the next method if the main test is true');
$f = new testFinder('Article');
$f->
  _if(false)->
  _elseif(true)->
    test()->
  _endif();
$t->is($f->getTest(), true, '_elseif() executes the next method if the main test is false and the endif test is true');
$f = new testFinder('Article');
$f->
  _if(false)->
  _elseif(false)->
    test()->
  _endif();
$t->is($f->getTest(), false, '_elseif() does not execute the next method if the main test is false and the endif test is false');

$t->diag('_else()');

$f = new testFinder('Article');
$f->
  _if(true)->
  _else()->
    test()->
  _endif();
$t->is($f->getTest(), false, '_else() does not execute the next method if the main test is true');
$f = new testFinder('Article');
$f->
  _if(false)->
  _else()->
    test()->
  _endif();
$t->is($f->getTest(), true, '_else() executes the next method if the main test is false');
$f = new testFinder('Article');
$f->
  _if(false)->
  _elseif(true)->
  _else()->
    test()->
  _endif();
$t->is($f->getTest(), false, '_else() does not execute the next method if the previous test is true');
$f->
  _if(false)->
  _elseif(false)->
  _else()->
    test()->
  _endif();
$t->is($f->getTest(), true, '_else() executes the next method if all the previous tests are false');

$t->diag('_endif()');

$f = new testFinder('Article');
$f->
  _if(true)->
    test()->
  _endif();
$t->isa_ok($f, 'testFinder', '_endif() returns the main finder object if the test is true');
$f = new testFinder('Article');
$f->
  _if(false)->
    test()->
  _endif();
$t->isa_ok($f, 'testFinder', '_endif() returns the main finder object if the test is false');
$f = new testFinder('Article');
$f->
  _if(true)->
  _endif()->
  test();
$t->is($f->getTest(), true, '_endif() stops the condition check');
$f = new testFinder('Article');
$f->
  _if(false)->
  _endif()->
  test();
$t->is($f->getTest(), true, '_endif() stops the condition check');
