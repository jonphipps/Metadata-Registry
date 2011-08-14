<?php
/*
 * This file is part of the sfPropelFinder package.
 * 
 * (c) 2009 Benjamin Runnels <kraven@kraven.org>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
You need a model built with a running database to run these tests.
The tests expect a model similar to this one:

    propel:
      article:
        id:          ~
        title:       varchar(255)
        category_id: ~
      category:
        id:          ~
        name:        varchar(255)
        
      sex:
        _attributes: { phpName: Civility }
        is_man:      boolean

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(21, new lime_output_color());

/*************************************/
/* sfPropelFinder::getColumnObject() */
/*************************************/

$t->diag('sfPropelFinder::getColumnObject()');

$finder = new sfPropelFinder('Article');

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
$t->ok($throwException, 'getColumnObject() throws an exception when its argument is not the CamelCase name of a column of the main finder object');

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
$t->isa_ok($column, 'ColumnMap', 'getColumnObject() returns a Propel column object when the column is found');

/***********************************/
/* sfPropelFinder::getColumnType() */
/***********************************/

$t->diag('sfPropelFinder::getColumnType()');

$finder = new sfPropelFinder('Article');

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

$finder = new sfPropelFinder('Civility');

$column = $finder->getColumnType('IsMan');
$t->is($column, sfModelFinderColumn::BOOLEAN, 'getColumnType() correctly matches BOOLEAN column types to sfModelFinderColumn::BOOLEAN');

/******************************/
/* sfPropelFinder::filterBy() */
/******************************/

$t->diag('sfPropelFinder::filterBy()');

$finder = new sfPropelFinder('Article');

$c = $finder->filterBy('Title', 'foo')->getCriteria();

$expectedC = new Criteria();
$expectedC->add(ArticlePeer::TITLE, 'foo', Criteria::EQUAL);

$t->ok($c->equals($expectedC), 'filterBy() called on a sfModelFinderColumn::STRING column type adds a WHERE ... = condition');

$finder = new sfPropelFinder('Article');

$c = $finder->filterBy('Title', '*foo*')->getCriteria();

$expectedC = new Criteria();
$expectedC->add(ArticlePeer::TITLE, '%foo%', Criteria::LIKE);

$t->ok($c->equals($expectedC), 'filterBy() called on a sfModelFinderColumn::STRING column type with wildcards adds a WHERE ... LIKE condition');

$finder = new sfPropelFinder('Article');

$c = $finder->filterBy('CategoryId', '1')->getCriteria();

$expectedC = new Criteria();
$expectedC->add(ArticlePeer::CATEGORY_ID, 1, Criteria::EQUAL);

$t->ok($c->equals($expectedC), 'filterBy() called on a sfModelFinderColumn::INTEGER column type adds a WHERE ... = condition');

$expectedC = new Criteria();
$expectedC->add(ArticlePeer::CATEGORY_ID, '1', Criteria::EQUAL);

$t->ok(!$c->equals($expectedC), 'filterBy() called on a sfModelFinderColumn::INTEGER column type converts the value to an integer');

$finder = new sfPropelFinder('Civility');

$c = $finder->filterBy('IsMan', '12')->getCriteria();

$expectedC = new Criteria();
$expectedC->add(CivilityPeer::IS_MAN, true, Criteria::EQUAL);

$t->ok($c->equals($expectedC), 'filterBy() called on a sfModelFinderColumn::BOOLEAN column type adds a WHERE ... = condition');

$expectedC = new Criteria();
$expectedC->add(CivilityPeer::IS_MAN, '12', Criteria::EQUAL);

$t->ok(!$c->equals($expectedC), 'filterBy() called on a sfModelFinderColumn::BOOLEAN column type converts the value to a boolean');

/****************************/
/* sfPropelFinder::filter() */
/****************************/

$t->diag('sfPropelFinder::filter()');

$finder = new sfPropelFinder('Article');

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

$c = $finder->filter(array(
  'Title' => '*foo*'
))->getCriteria();

$expectedC = new Criteria();
$expectedC->add(ArticlePeer::TITLE, '%foo%', Criteria::LIKE);

$t->ok($c->equals($expectedC), 'filter() calls filterBy() on each condition');

$finder = new sfPropelFinder('Article');

$query = 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article WHERE (article.TITLE LIKE \'%foo%\' AND article.CATEGORY_ID=1)';

$articles = $finder->filter(array(
  'Title' => '*foo*',
  'CategoryId' => '1'
))->find();

$t->is($finder->getLatestQuery(), $query, 'filter() calls filterBy() on each condition');

$finder = new sfPropelFinder('Article');
$articles = $finder->filter(array(
  'title' => '*foo*',
  'category_id' => '1'
), true)->find();

$t->is($finder->getLatestQuery(), $query, 'filter() converts underscore column names to CamelCase when the second argument is true');

$finder = new sfPropelFinder('Article');
$c = $finder->filter(array(
  'Title' => '*foo*',
  'CategoryId' => '1'
), false, array('Title'))->getCriteria();

$expectedC = new Criteria();
$expectedC->add(ArticlePeer::TITLE, '%foo%', Criteria::LIKE);

$t->ok($c->equals($expectedC), 'filter() ignores column names that are not part of the third argument if passed');

$called = false;

class myArticleFinder extends DbFinder
{
  protected $class = 'Article';
  
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
