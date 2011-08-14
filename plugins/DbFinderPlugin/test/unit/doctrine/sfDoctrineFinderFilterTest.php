<?php
/*
 * This file is part of the sfDoctrineFinder package.
 * 
 * (c) 2009 Benjamin Runnels <kraven@kraven.org>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
You need a model built with a running database to run these tests.
The tests expect a model similar to this one:

    DArticle:
      columns:
        title:       string(255)
        category_id: integer
        content:     string(255)
      relations:
        Category:
          class:    DCategory
          local:    category_id
          type:     one
          foreign:  id
          foreignAlias: Articles

    DCivility:
      columns:
        is_man:      boolean

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(21, new lime_output_color());

/***************************************/
/* sfDoctrineFinder::getColumnObject() */
/***************************************/

$t->diag('sfDoctrineFinder::getColumnObject()');

$finder = new sfDoctrineFinder('DArticle');

try 
{
  $finder->getColumnObject('Foo');
  $throwException = false;
}
catch (Exception $e)
{
  $throwException = true;
}
$t->ok($throwException, 'getColumnObject() throws an exception when its argument is not the name of a column of the main finder object');

try 
{
  $finder->getColumnObject('title');
  $throwException = false;
}
catch (Exception $e)
{
  $throwException = true;
}
$t->ok(!$throwException, 'getColumnObject() does not throw an exception when its argument is the underscore name of a column of the main finder object');

try 
{
  $finder->getColumnObject('Title');
  $throwException = false;
}
catch (Exception $e)
{
  $throwException = true;
}
$t->ok(!$throwException, 'getColumnObject() does not throw an exception when its argument is the CamelCase name of a column of the main finder object');

$column = $finder->getColumnObject('Title');
$doctrineColumnClass = class_exists('sfDoctrineAdminColumn') ? 'sfDoctrineAdminColumn' : 'sfDoctrineColumn';
$t->isa_ok($column, $doctrineColumnClass, 'getColumnObject() returns a Doctrine column object when the column is found');

/*************************************/
/* sfDoctrineFinder::getColumnType() */
/*************************************/

$t->diag('sfDoctrineFinder::getColumnType()');

$finder = new sfDoctrineFinder('DArticle');

try 
{
  $finder->getColumnType('Foo');
  $throwException = false;
}
catch (Exception $e)
{
  $throwException = true;
}
$t->ok($throwException, 'getColumnType() throws an exception when its argument is not the name of a column of the main finder object');

$column = $finder->getColumnType('Title');
$t->isa_ok($column, 'string', 'getColumnType() returns a string representing a sfModelFinder column type');

$t->is($column, sfModelFinderColumn::STRING, 'getColumnType() correctly matches VARCHAR column types to sfModelFinderColumn::STRING');
$column = $finder->getColumnType('CategoryId');
$t->is($column, sfModelFinderColumn::INTEGER, 'getColumnType() correctly matches INTEGER column types to sfModelFinderColumn::INTEGER');

$finder = new sfDoctrineFinder('DCivility');

$column = $finder->getColumnType('IsMan');
$t->is($column, sfModelFinderColumn::BOOLEAN, 'getColumnType() correctly matches BOOLEAN column types to sfModelFinderColumn::BOOLEAN');

/********************************/
/* sfDoctrineFinder::filterBy() */
/********************************/

$t->diag('sfDoctrineFinder::filterBy()');

$finder = new sfDoctrineFinder('DArticle');
$finder->filterBy('Title', 'foo')->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE d.title = \'foo\'', 'filterBy() called on a sfModelFinderColumn::STRING column type adds a WHERE ... = condition');

$finder = new sfDoctrineFinder('DArticle');
$finder->filterBy('Title', '*foo*')->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE d.title LIKE \'%foo%\'', 'filterBy() called on a sfModelFinderColumn::STRING column type with wildcards adds a WHERE ... LIKE condition');

$finder = new sfDoctrineFinder('DArticle');
$finder->filterBy('CategoryId', 1)->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE d.category_id = \'1\'', 'filterBy() called on a sfModelFinderColumn::INTEGER column type adds a WHERE ... = condition');


$finder = new sfDoctrineFinder('DArticle');
$finder->filterBy('CategoryId', ' 1 ')->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE d.category_id = \'1\'', 'filterBy() called on a sfModelFinderColumn::INTEGER column type converts the value to an integer');

$finder = new sfDoctrineFinder('DCivility');
$finder->filterBy('IsMan', true)->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.is_man AS d__is_man FROM d_civility d WHERE d.is_man = \'1\'', 'filterBy() called on a sfModelFinderColumn::BOOLEAN column type adds a WHERE ... = condition');

$finder = new sfDoctrineFinder('DCivility');
$finder->filterBy('IsMan', '12')->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.is_man AS d__is_man FROM d_civility d WHERE d.is_man = \'1\'', 'filterBy() called on a sfModelFinderColumn::BOOLEAN column type converts the value to a boolean');

/****************************/
/* sfDoctrineFinder::filter() */
/****************************/

$t->diag('sfDoctrineFinder::filter()');

$finder = new sfDoctrineFinder('DArticle');

try 
{
  $finder->filter('Foo');
  $throwException = false;
}
catch (Exception $e)
{
  $throwException = true;
}
$t->ok($throwException, 'filter() throws an exception when its first argument is not an array of conditions');

$finder->filter(array(
  'Title' => '*foo*'
))->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE d.title LIKE \'%foo%\'', 'filter() calls filterBy() on each condition');

$finder = new sfDoctrineFinder('DArticle');

$query = 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE (d.title LIKE \'%foo%\' AND d.category_id = \'1\')';

$articles = $finder->filter(array(
  'Title' => '*foo*',
  'CategoryId' => '1'
))->find();

$t->is($finder->getLatestQuery(), $query, 'filter() calls filterBy() on each condition');

$finder = new sfDoctrineFinder('DArticle');
$articles = $finder->filter(array(
  'title' => '*foo*',
  'category_id' => '1'
), true)->find();

$t->is($finder->getLatestQuery(), $query, 'filter() converts underscore column names to CamelCase when the second argument is true');

$finder = new sfDoctrineFinder('DArticle');
$finder->filter(array(
  'Title' => '*foo*',
  'CategoryId' => '1'
), false, array('Title'))->find();

$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE d.title LIKE \'%foo%\'', 'filter() ignores column names that are not part of the third argument if passed');

$called = false;

class myArticleFinder extends DbFinder
{
  protected $class = 'DArticle';
  
  public function filterByTitle($value)
  {
    global $called;
    $called = $value;
  }
}

$finder = new myArticleFinder();
$articles = $finder->filter(array(
  'Title' => 'bar'
))->find();

$t->is($called, 'bar', 'filter() calls custom filterByKey() method instead of filterBy() if the method exists');
