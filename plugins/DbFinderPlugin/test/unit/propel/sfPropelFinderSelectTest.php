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
      
      foo:
        reallylongcolumnnameforassoctesting:  varchar(255)

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(79, new lime_output_color());

/****************************/
/* sfPropelFinder::select() */
/****************************/

$t->diag('sfPropelFinder::select()');

try 
{
  sfPropelFinder::from('Category')->select();
  $exceptionThrown = false;
}
catch (Exception $e) 
{
  $exceptionThrown = true;
}

$t->is($exceptionThrown, true, 'select() throws an exception if called without parameter');

try 
{
  sfPropelFinder::from('Category')->select(array());
  $exceptionThrown = false;
}
catch (Exception $e) 
{
  $exceptionThrown = true;
}

$t->is($exceptionThrown, true, 'select() throws an exception if called with an empty parameter');

/**********************************************/
/* sfPropelFinder::select($string) and find() */
/**********************************************/

$t->diag('sfPropelFinder::select(string) and find()');

ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();

$finder = sfPropelFinder::from('Category')->select('Name');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS Name FROM category'), 'find() called after select(string) selects a single column');
$t->isa_ok($categories, 'array', 'find() called after select(string) returns an array');
$t->is(count($categories), 0, 'find() called after select(string) returns an empty array if no record is found');

$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();

$finder = sfPropelFinder::from('Category')->select('Name');
$categories = $finder->find();
$t->is(count($categories), 2, 'find() called after select(string) returns an array with one row for each record');
$t->is(array_shift($categories), 'cat1', 'find() called after select(string) returns an array of column values');
$t->is(array_shift($categories), 'cat2', 'find() called after select(string) returns an array of column values');

$finder = sfPropelFinder::from('Category')->select('Category.Name');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS "Category.Name" FROM category'), 'select() accepts complete column names');

$finder = sfPropelFinder::from('Category c')->select('c.Name');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS "c.Name" FROM category'), 'select() accepts complete column names with table aliases');

/*****************************************************/
/* sfPropelFinder::select(string) and finder methods */
/*****************************************************/

$t->diag('sfPropelFinder::select(string) and finder methods');

$finder = sfPropelFinder::from('Category')->
  select('Name')->
  where('Name', 'cat1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS Name FROM category WHERE category.NAME=\'cat1\''), 'select() allows for where() statements');
$t->isa_ok($categories, 'array', 'select() allows for where() statements');
$t->is(count($categories), 1, 'select() allows for where() statements');

$article1 = new Article();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();

$finder = sfPropelFinder::from('Category')->
  select('Name')->
  join('Article')->
  where('Article.Title', 'art1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS Name FROM category INNER JOIN article ON (category.ID=article.CATEGORY_ID) WHERE article.TITLE=\'art1\''), 'select() allows for join() statements');
$t->isa_ok($categories, 'array', 'select() allows for join() statements');
$t->is(count($categories), 1, 'select() allows for join() statements');

try
{
  $scalar = sfPropelFinder::from('Category')->
    select('Article.Title')->
    join('Article')->
    where('Article.Title', 'art1')->
    find();
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'find() does not throw an exception when the requested column does not belong to the start class');

/************************************************/
/* sfPropelFinder::select(string) and findOne() */
/************************************************/

$t->diag('sfPropelFinder::select(string) and findOne()');

$finder = sfPropelFinder::from('Category')->select('Name');
$category = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS Name FROM category LIMIT 1'), 'findOne() called after select(string) selects a single column and requests a single row');
$t->isa_ok($category, 'string', 'findOne() called after select(string) returns a string');
$t->is($category, 'cat1', 'findOne() called after select(string) returns the column value of the first row matching the query');

ArticlePeer::doDeleteAll();

$title = sfPropelFinder::from('Article')->select('Title')->findOne();
$t->isa_ok($title, 'NULL', 'findOne() called after select(string) returns null when no record is found');

/*******************************/
/* sfPropelFinder::select('*') */
/*******************************/

$t->diag('sfPropelFinder::select(\'*\')');

$finder = sfPropelFinder::from('Category')->select('*');
$category = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.ID AS "Category.Id", category.NAME AS "Category.Name" FROM category LIMIT 1'), 'select(\'*\') selects all the columns from the main object');
$t->isa_ok($category, 'array', 'findOne() called after select(\'*\') returns an array');
$t->is_deeply(array_keys($category), array('Category.Id', 'Category.Name'), 'select(\'*\') returns all the columns from the main object, in complete form');

/*************************************************************/
/* sfPropelFinder::select(array, sfModelFinder::ASSOCIATIVE) */
/*************************************************************/

$t->diag('sfPropelFinder::select(array, sfModelFinder::ASSOCIATIVE)');

ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();

$finder = sfPropelFinder::from('Category')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.ID AS Id, category.NAME AS Name FROM category'), 'find() called after select(array) selects several columns');
$t->isa_ok($categories, 'array', 'find() called after select(array) returns an array');
$t->is(count($categories), 0, 'find() called after select(array) returns an empty array if no record is found');

$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();

$finder = sfPropelFinder::from('Category')->
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

$finder = sfPropelFinder::from('Category')->
  select(array('Category.Id', 'Category.Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.ID AS "Category.Id", category.NAME AS "Category.Name" FROM category'), 'select(array) accepts complete column names');
$cat1 = array_shift($categories);
$t->is_deeply(array_keys($cat1), array('Category.Id', 'Category.Name'), 'Each row returned by find() after select(array) is an associative array where the keys are the requested complete column names');

$finder = sfPropelFinder::from('Category c')->
  select(array('c.Id', 'c.Name'), sfModelFinder::ASSOCIATIVE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.ID AS "c.Id", category.NAME AS "c.Name" FROM category'), 'select(array) accepts complete column names with table aliases');
$cat1 = array_shift($categories);
$t->is_deeply(array_keys($cat1), array('c.Id', 'c.Name'), 'Each row returned by find() after select(array) is an associative array where the keys are the requested complete column names with table aliases');

$finder = sfPropelFinder::from('Category')->
  select(array('Id','Name'));
$categories = $finder->find();
$cat1 = array_shift($categories);
$t->is_deeply(array_keys($cat1), array('Id', 'Name'), 'select(array) uses the associative mode by default');

$foo1 = new Foo();
$foo1->setReallylongcolumnnameforassoctesting('long1');
$foo1->save();

// fix for a bug/limitation in pdo_dblib where it truncates columnnames to a maximum of 31 characters when doing PDO::FETCH_ASSOC
$finder = sfPropelFinder::from('Foo')->
  select(array('Foo.Reallylongcolumnnameforassoctesting'));
$foo = $finder->findOne();
$t->is_deeply($foo, array('Foo.Reallylongcolumnnameforassoctesting' => 'long1'), 'select() does not mind long column names');

/********************************************************/
/* sfPropelFinder::select(array, sfModelFinder::SIMPLE) */
/********************************************************/

$t->diag('sfPropelFinder::select(array, sfModelFinder::SIMPLE)');

ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();

$finder = sfPropelFinder::from('Category')->
  select(array('Id','Name'), sfModelFinder::SIMPLE);
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.ID AS Id, category.NAME AS Name FROM category'), 'find() called after select(array) selects several columns');
$t->isa_ok($categories, 'array', 'find() called after select(array) returns an array');
$t->is(count($categories), 0, 'find() called after select(array) returns an empty array if no record is found');

$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();

$categories = sfPropelFinder::from('Category')->
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

/****************************************************/
/* sfPropelFinder::select(array) and finder methods */
/****************************************************/

$t->diag('sfPropelFinder::select(array) and finder methods');

$finder = sfPropelFinder::from('Category')->
  select(array('Name'))->
  where('Name', 'cat1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS Name FROM category WHERE category.NAME=\'cat1\''), 'select(array) allows for where() statements');
$t->isa_ok($categories, 'array', 'select(array) allows for where() statements');
$t->is(count($categories), 1, 'select(array) allows for where() statements');

$article1 = new Article();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();

$finder = sfPropelFinder::from('Category')->
  select(array('Name'))->
  join('Article')->
  where('Article.Title', 'art1');
$categories = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS Name FROM category INNER JOIN article ON (category.ID=article.CATEGORY_ID) WHERE article.TITLE=\'art1\''), 'select(array) allows for join() statements');
$t->isa_ok($categories, 'array', 'select(array) allows for join() statements');
$t->is(count($categories), 1, 'select(array) allows for join() statements');

try
{
  sfPropelFinder::from('Category')->
    join('Article')->
    select(array('Article.Title', 'Article.Id'))->
    find();
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'find() called after select(array) does not throw an exception when none of the requested columns belong to the start class');

/*****************************************************************/
/* sfPropelFinder::select(array) and columns from several tables */
/*****************************************************************/

$t->diag('sfPropelFinder::select(array) and columns from several tables');

ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('art2');
$article2->setCategory($category2);
$article2->save();
$article3 = new Article();
$article3->setTitle('art3');
$article3->setCategory($category1);
$article3->save();

$finder = sfPropelFinder::from('Article')->
  join('Category')->
  select(array('Article.Title', 'Category.Name'));
$rows = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12article.ID, ]article.TITLE AS "Article.Title", category.NAME AS "Category.Name" FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID)'), 'select(array) can select columns from several tables (many-to-one)');

$expectedRows = array(
  array(
    'Article.Title' => 'art1',
    'Category.Name' => 'cat1'
  ),
  array(
    'Article.Title' => 'art2',
    'Category.Name' => 'cat2'
  ),
  array(
    'Article.Title' => 'art3',
    'Category.Name' => 'cat1'
  )
);
$t->is_deeply($rows, $expectedRows, 'find() called after select(array) returns columns from several tables (many-to-one');

$finder = sfPropelFinder::from('Category')->
  join('Article')->
  select(array('Category.Name', 'Article.Title'))->
  orderBy('Category.Id')->
  orderBy('Article.Id');
$rows = $finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.NAME AS "Category.Name", article.TITLE AS "Article.Title" FROM category INNER JOIN article ON (category.ID=article.CATEGORY_ID) ORDER BY category.ID ASC,article.ID ASC'), 'select(array) can select columns from several tables (one-to-many)');

$expectedRows = array(
  array(
    'Category.Name' => 'cat1',
    'Article.Title' => 'art1'
  ),
  array(
    'Category.Name' => 'cat1',
    'Article.Title' => 'art3'
  ),
  array(
    'Category.Name' => 'cat2',
    'Article.Title' => 'art2'
  )
);
$t->is_deeply($rows, $expectedRows, 'find() called after select(array) returns columns from several tables (one-to-many)');

/***********************************************/
/* sfPropelFinder::select(array) and findOne() */
/***********************************************/

$t->diag('sfPropelFinder::select(array) and findOne()');

ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();

$finder = sfPropelFinder::from('Category')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$category = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12category.ID, ]category.ID AS Id, category.NAME AS Name FROM category LIMIT 1'), 'findOne() called after select(array) selects several columns and requests a single row');
$t->isa_ok($category, 'array', 'findOne() called after select(array) returns an array');
$t->is(count($category), 0, 'findOne() called after select(array) returns an empty array if no record is found');

$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();

$finder = sfPropelFinder::from('Category')->
  select(array('Id','Name'), sfModelFinder::ASSOCIATIVE);
$category = $finder->findOne();
$t->isa_ok($category, 'array', 'The row returned by findOne() called after select(array) is an array');
$t->is_deeply(array_keys($category), array('Id', 'Name'), 'The row returned by findOne() called after select(array, sfModelFinder::ASSOCIATIVE) is an associative array where the keys are the requested column names');
$t->is($category['Id'], $category1->getId(), 'The row returned by findOne() called after select(array, sfModelFinder::ASSOCIATIVE) is an associative array where the values are the requested column values');
$t->is($category['Name'], $category1->getName(), 'The row returned by findOne() called after select(array, sfModelFinder::ASSOCIATIVE) is an associative array where the values are the requested column values');

$finder = sfPropelFinder::from('Category')->
  select(array('Id','Name'), sfModelFinder::SIMPLE);
$category = $finder->findOne();
$t->is_deeply(array_keys($category), array(0, 1), 'The row returned by findOne() called after select(array, sfModelFinder::SIMPLE) is an array with numeric keys');
$t->is($category[0], $category1->getId(), 'The row returned by findOne() called after select(array, sfModelFinder::SIMPLE) is an array where the values are the requested column values');
$t->is($category[1], $category1->getName(), 'The row returned by findOne() called after select(array, sfModelFinder::SIMPLE) is an array where the values are the requested column values');

/*********************************************/
/* sfPropelFinder::select() and withColumn() */
/*********************************************/

$t->diag('sfPropelFinder::select() and withColumn()');

ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('art1');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('art2');
$article2->setCategory($category2);
$article2->save();
$article3 = new Article();
$article3->setTitle('art3');
$article3->setCategory($category1);
$article3->save();

$finder = sfPropelFinder::from('Article')->
  withColumn('Article.Title')->
  select('Article.Title');
$title = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12article.ID, ]article.TITLE AS "Article.Title" FROM article LIMIT 1'), 'select() can cope with a column added with withColumn()');
$t->is($title, 'art1', 'select() can cope with a column added with withColumn()');

$finder = sfPropelFinder::from('Article')->
  join('Category')->
  withColumn('Category.Name')->
  select(array('Article.Title', 'Category.Name'));
$row = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12article.ID, ]category.NAME AS "Category.Name", article.TITLE AS "Article.Title" FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) LIMIT 1'), 'find() does not request twice the columns added by way of withColumn() and select()');
$expectedRow = array(
  'Article.Title' => 'art1',
  'Category.Name' => 'cat1'
);
$t->is_deeply($row, $expectedRow, 'select() can select columns added by way of withColumn()');

$finder = sfPropelFinder::from('Article')->
  join('Category')->
  withColumn('Category.Name', 'cname')->
  select(array('Article.Title', 'cname'));
$row = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12article.ID, ]category.NAME AS cname, article.TITLE AS "Article.Title" FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) LIMIT 1'), 'select() uses any alias specified in withColumn() in the query');
$expectedRow = array(
  'Article.Title' => 'art1',
  'cname'         => 'cat1'
);
$t->is_deeply($row, $expectedRow, 'select() uses any alias specified in withColumn() in the result');

$finder = sfPropelFinder::from('Article')->
  join('Category')->
  withColumn('Category.Name')->
  withColumn('Article.Title')->
  select(array('Article.Title', 'Category.Name'));
$row = $finder->findOne();
$t->is($finder->getLatestQuery(), propel_sql('SELECT [P12article.ID, ]category.NAME AS "Category.Name", article.TITLE AS "Article.Title" FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) LIMIT 1'), 'select() can cope with only columns added with withColumn()');
$expectedRow = array(
  'Article.Title' => 'art1',
  'Category.Name' => 'cat1'
);
$t->is_deeply($row, $expectedRow, 'select() can cope with only columns added with withColumn()');