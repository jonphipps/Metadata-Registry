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

connection:    doctrine

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

    DCategory:
      columns:
        name:        string(255)

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(74, new lime_output_color());

/******************************/
/* sfDoctrineFinder::select() */
/******************************/

$t->diag('sfDoctrineFinder::select()');

try 
{
  sfDoctrineFinder::from('Category')->select();
  $exceptionThrown = false;
}
catch (Exception $e) 
{
  $exceptionThrown = true;
}

$t->is($exceptionThrown, true, 'select() throws an exception if called without parameter');

try 
{
  sfDoctrineFinder::from('Category')->select(array());
  $exceptionThrown = false;
}
catch (Exception $e) 
{
  $exceptionThrown = true;
}

$t->is($exceptionThrown, true, 'select() throws an exception if called with an empty parameter');

/************************************************/
/* sfDoctrineFinder::select($string) and find() */
/************************************************/

$t->diag('sfDoctrineFinder::select(string) and find()');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();

$finder = sfDoctrineFinder::from('DArticle')->select('Title');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.title AS d__title FROM d_article d'), 'find() called after select(string) selects a single column');
$t->isa_ok($categories, 'array', 'find() called after select(string) returns an array');
$t->is(count($categories), 0, 'find() called after select(string) returns an empty array if no record is found');

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();

$finder = sfDoctrineFinder::from('DCategory')->select('Name');
$categories = $finder->find();
$t->is(count($categories), 2, 'find() called after select(string) returns an array with one row for each record');
$t->is(array_shift($categories), 'cat1', 'find() called after select(string) returns an array of column values');
$t->is(array_shift($categories), 'cat2', 'find() called after select(string) returns an array of column values');

$finder = sfDoctrineFinder::from('DCategory')->select('DCategory.Name');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d'), 'select() accepts complete column names');

$finder = sfDoctrineFinder::from('DCategory c')->select('c.Name');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d'), 'select() accepts complete column names with table aliases');

/*******************************************************/
/* sfDoctrineFinder::select(string) and finder methods */
/*******************************************************/

$t->diag('sfDoctrineFinder::select(string) and finder methods');

$finder = sfDoctrineFinder::from('DCategory')->
  select('Name')->
  where('Name', 'cat1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d WHERE d.name = \'cat1\''), 'select() allows for where() statements');
$t->isa_ok($categories, 'array', 'select() allows for where() statements');
$t->is(count($categories), 1, 'select() allows for where() statements');

$article1 = new DArticle();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();

$finder = sfDoctrineFinder::from('DCategory')->
  select('Name')->
  join('DArticle')->
  where('DArticle.Title', 'art1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d INNER JOIN d_article d2 ON d.id = d2.category_id WHERE d2.title = \'art1\''), 'select() allows for join() statements');
$t->isa_ok($categories, 'array', 'select() allows for join() statements');
$t->is(count($categories), 1, 'select() allows for join() statements');

try
{
  $scalar = sfDoctrineFinder::from('DCategory')->
    select('DArticle.Title')->
    join('DArticle')->
    where('DArticle.Title', 'art1')->
    find();
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'find() does not throw an exception when the requested column does not belong to the start class');

/**************************************************/
/* sfDoctrineFinder::select(string) and findOne() */
/**************************************************/

$t->diag('sfDoctrineFinder::select(string) and findOne()');

$finder = sfDoctrineFinder::from('DCategory')->select('Name');
$category = $finder->findOne();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d LIMIT 1'), 'findOne() called after select(string) selects a single column and requests a single row');
$t->isa_ok($category, 'string', 'findOne() called after select(string) returns a string');
$t->is($category, 'cat1', 'findOne() called after select(string) returns the column value of the first row matching the query');

Doctrine_Query::create()->delete()->from('DArticle')->execute();

$title = sfDoctrineFinder::from('DArticle')->select('Title')->findOne();
$t->isa_ok($title, 'NULL', 'findOne() called after select(string) returns null when no record is found');

/*********************************/
/* sfDoctrineFinder::select('*') */
/*********************************/

$t->diag('sfDoctrineFinder::select(\'*\')');

$finder = sfDoctrineFinder::from('DCategory')->select('*');
$category = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name FROM d_category d LIMIT 1', 'select(\'*\') selects all the columns from the main object');
$t->isa_ok($category, 'array', 'findOne() called after select(\'*\') returns an array');
$t->is_deeply(array_keys($category), array('DCategory.Id', 'DCategory.Name'), 'select(\'*\') returns all the columns from the main object, in complete form');

/*************************************************************/
/* sfDoctrineFinder::select(array, sfModelFinder::ASSOCIATIVE) */
/*************************************************************/

$t->diag('sfDoctrineFinder::select(array, sfModelFinder::ASSOCIATIVE)');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name FROM d_category d', 'find() called after select(array) selects several columns');
$t->isa_ok($categories, 'array', 'find() called after select(array) returns an array');
$t->is(count($categories), 0, 'find() called after select(array) returns an empty array if no record is found');

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();

$t->is(count($categories), 2, 'find() called after select(array) returns an array with one row for every record');
$cat1 = array_shift($categories);
$cat2 = array_shift($categories);
$t->isa_ok($cat1, 'array', 'find() called after select(array) returns an array of arrays');
$t->is_deeply(array_keys($cat1), array('Id', 'Name'), 'Each row returned by find() after select(array) is an associative array where the keys are the requested column names');
$t->is($cat1['Id'], $category1->getId(), 'Each row returned by find() after select(array) is an associative array where the values are the requested column values');
$t->is($cat2['Id'], $category2->getId(), 'Each row returned by find() after select(array) is an associative array where the values are the requested column values');
$t->is($cat1['Name'], $category1->getName(), 'Each row returned by find() after select(array) is an associative array where the values are the requested column values');
$t->is($cat2['Name'], $category2->getName(), 'Each row returned by find() after select(array) is an associative array where the values are the requested column values');

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('DCategory.Id', 'DCategory.Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name FROM d_category d', 'select(array) accepts complete column names');
$cat1 = array_shift($categories);
$t->is_deeply(array_keys($cat1), array('DCategory.Id', 'DCategory.Name'), 'Each row returned by find() after select(array) is an associative array where the keys are the requested complete column names');

$finder = sfDoctrineFinder::from('DCategory c')->
  select(array('c.Id', 'c.Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name FROM d_category d', 'select(array) accepts complete column names with table aliases');
$cat1 = array_shift($categories);
$t->is_deeply(array_keys($cat1), array('c.Id', 'c.Name'), 'Each row returned by find() after select(array) is an associative array where the keys are the requested complete column names with table aliases');

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'));
$categories = $finder->find();
$cat1 = array_shift($categories);
$t->is_deeply(array_keys($cat1), array('Id', 'Name'), 'select(array) uses the associative mode by default');

/*
$foo1 = new Foo();
$foo1->setReallylongcolumnnameforassoctesting('long1');
$foo1->save();

// fix for a bug/limitation in pdo_dblib where it truncates columnnames to a maximum of 31 characters when doing PDO::FETCH_ASSOC
$finder = sfDoctrineFinder::from('Foo')->
  select(array('Foo.Reallylongcolumnnameforassoctesting'));
$foo = $finder->findOne();
$t->is_deeply($foo, array('Foo.Reallylongcolumnnameforassoctesting' => 'long1'), 'select() does not mind long column names');
*/
/**********************************************************/
/* sfDoctrineFinder::select(array, sfModelFinder::SIMPLE) */
/**********************************************************/

$t->diag('sfDoctrineFinder::select(array, sfModelFinder::SIMPLE)');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::SIMPLE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name FROM d_category d', 'find() called after select(array) selects several columns');
$t->isa_ok($categories, 'array', 'find() called after select(array) returns an array');
$t->is(count($categories), 0, 'find() called after select(array) returns an empty array if no record is found');

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();

$categories = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::SIMPLE)->
  find();
$t->is(count($categories), 2, 'find() called after select(array) returns an array with one row for every record');
$cat1 = array_shift($categories);
$cat2 = array_shift($categories);
$t->isa_ok($cat1, 'array', 'Each row returned by find() called after select(array) is an array');
$t->is_deeply(array_keys($cat1), array(0, 1), 'Each row returned by find() called after select(array) is an array with numerical keys');
$t->is($cat1[0], $category1->getId(), 'Each row returned by find() called after select(array) is an array where the values are the requested column values');
$t->is($cat2[0], $category2->getId(), 'Each row returned by find() called after select(array) is an array where the values are the requested column values');
$t->is($cat1[1], $category1->getName(), 'Each row returned by find() called after select(array) is an array where the values are the requested column values');
$t->is($cat2[1], $category2->getName(), 'Each row returned by find() called after select(array) is an array where the values are the requested column values');

/******************************************************/
/* sfDoctrineFinder::select(array) and finder methods */
/******************************************************/

$t->diag('sfDoctrineFinder::select(array) and finder methods');

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Name'))->
  where('Name', 'cat1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d WHERE d.name = \'cat1\''), 'select(array) allows for where() statements');
$t->isa_ok($categories, 'array', 'select(array) allows for where() statements');
$t->is(count($categories), 1, 'select(array) allows for where() statements');

$article1 = new DArticle();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Name'))->
  join('DArticle')->
  where('DArticle.Title', 'art1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name FROM d_category d INNER JOIN d_article d2 ON d.id = d2.category_id WHERE d2.title = \'art1\''), 'select(array) allows for join() statements');
$t->isa_ok($categories, 'array', 'select(array) allows for join() statements');
$t->is(count($categories), 1, 'select(array) allows for join() statements');

try
{
  sfDoctrineFinder::from('DCategory')->
    join('DArticle')->
    select(array('DArticle.Title', 'DArticle.Id'))->
    find();
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'find() called after select(array) does not throw an exception when none of the requested columns belong to the start class');

/*******************************************************************/
/* sfDoctrineFinder::select(array) and columns from several tables */
/*******************************************************************/

$t->diag('sfDoctrineFinder::select(array) and columns from several tables');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();
$article1 = new DArticle();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('art2');
$article2->setCategory($category2);
$article2->save();
$article3 = new DArticle();
$article3->setTitle('art3');
$article3->setCategory($category1);
$article3->save();

$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  select(array('DArticle.Title', 'DCategory.Name'));
$rows = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.title AS d__title, [D011d2.id AS d2__id, ]d2.name AS d2__name FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id'), 'select(array) can select columns from several tables (many-to-one)');

$expectedRows = array(
  array(
    'DArticle.Title' => 'art1',
    'DCategory.Name' => 'cat1'
  ),
  array(
    'DArticle.Title' => 'art2',
    'DCategory.Name' => 'cat2'
  ),
  array(
    'DArticle.Title' => 'art3',
    'DCategory.Name' => 'cat1'
  )
);
$t->is_deeply($rows, $expectedRows, 'find() called after select(array) returns columns from several tables (many-to-one)');

$finder = sfDoctrineFinder::from('DCategory')->
  join('DArticle')->
  select(array('DCategory.Name', 'DArticle.Title'))->
  orderBy('DCategory.Id');
$rows = $finder->find();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.name AS d__name, [D011d2.id AS d2__id, ]d2.title AS d2__title FROM d_category d INNER JOIN d_article d2 ON d.id = d2.category_id ORDER BY d.id ASC'), 'select(array) can select columns from several tables (one-to-many)');

$expectedRows = array(
  array(
    'DCategory.Name' => 'cat1',
    'DArticle.Title' => 'art1'
  ),
  array(
    'DCategory.Name' => 'cat1',
    'DArticle.Title' => 'art3'
  ),
  array(
    'DCategory.Name' => 'cat2',
    'DArticle.Title' => 'art2'
  )
);
$t->is_deeply($rows, $expectedRows, 'find() called after select(array) returns columns from several tables (one-to-many)');

/***********************************************/
/* sfDoctrineFinder::select(array) and findOne() */
/***********************************************/

$t->diag('sfDoctrineFinder::select(array) and findOne()');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$category = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name FROM d_category d LIMIT 1', 'findOne() called after select(array) selects several columns and requests a single row');
$t->isa_ok($category, 'array', 'findOne() called after select(array) returns an array');
$t->is(count($category), 0, 'findOne() called after select(array) returns an empty array if no record is found');

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$category = $finder->findOne();
$t->isa_ok($category, 'array', 'The row returned by findOne() called after select(array) is an array');
$t->is_deeply(array_keys($category), array('Id', 'Name'), 'The row returned by findOne() called after select(array, sfModelFinder::ASSOCIATIVE) is an associative array where the keys are the requested column names');
$t->is($category['Id'], $category1->getId(), 'The row returned by findOne() called after select(array, sfModelFinder::ASSOCIATIVE) is an associative array where the values are the requested column values');
$t->is($category['Name'], $category1->getName(), 'The row returned by findOne() called after select(array, sfModelFinder::ASSOCIATIVE) is an associative array where the values are the requested column values');

$finder = sfDoctrineFinder::from('DCategory')->
  select(array('Id','Name'), sfModelFinder::SIMPLE);
$category = $finder->findOne();
$t->is_deeply(array_keys($category), array(0, 1), 'The row returned by findOne() called after select(array, sfModelFinder::SIMPLE) is an array with numeric keys');
$t->is($category[0], $category1->getId(), 'The row returned by findOne() called after select(array, sfModelFinder::SIMPLE) is an array where the values are the requested column values');
$t->is($category[1], $category1->getName(), 'The row returned by findOne() called after select(array, sfModelFinder::SIMPLE) is an array where the values are the requested column values');

/*********************************************/
/* sfDoctrineFinder::select() and withColumn() */
/*********************************************/

$t->diag('sfDoctrineFinder::select() and withColumn()');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();
$article1 = new DArticle();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('art2');
$article2->setCategory($category2);
$article2->save();
$article3 = new DArticle();
$article3->setTitle('art3');
$article3->setCategory($category1);
$article3->save();

$finder = sfDoctrineFinder::from('DArticle')->
  withColumn('DCategory.Name')->
  select(array('DArticle.Title', 'DCategory.Name'));
$data = $finder->findOne();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.title AS d__title, d2.name AS d2__0 FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id LIMIT 1'), 'select() can cope with a column added with withColumn()');
$t->is_deeply($data, array('DArticle.Title' => 'art1', 'DCategory.Name' => 'cat1'), 'find() does not request twice the columns added by way of withColumn() and select()');

$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  withColumn('DCategory.Name', 'cname')->
  select(array('DArticle.Title', 'cname'));
$row = $finder->findOne();
$t->is($finder->getLatestQuery(), doctrine_sql('SELECT [D011d.id AS d__id, ]d.title AS d__title, d2.name AS d2__0 FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id LIMIT 1'), 'select() uses any alias specified in withColumn() in the query');
$expectedRow = array(
  'DArticle.Title' => 'art1',
  'cname'          => 'cat1'
);
$t->is_deeply($row, $expectedRow, 'select() uses any alias specified in withColumn() in the result');