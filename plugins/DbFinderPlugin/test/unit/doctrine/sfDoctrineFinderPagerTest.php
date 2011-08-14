<?php
/*
 * This file is part of the sfDoctrineFinder package.
 * 
 * (c) 2007 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
You need a model built with a running database to run these tests.
The tests expect a model similar to this one:

    propel:
      DArticle:
        id:          ~
        title:       varchar(255)

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

// cleanup database
Doctrine_Query::create()->delete()->from('DAuthor')->execute();
Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();

$t = new lime_test(33, new lime_output_color());

$article1 = new DArticle();
$article1->setTitle('tt1');
$article1->save();
$article2 = new DArticle();
$article2->setTitle('tt2');
$article2->save();
$article3 = new DArticle();
$article3->setTitle('tt3');
$article3->save();
$article4 = new DArticle();
$article4->setTitle('tt4');
$article4->save();
$article5 = new DArticle();
$article5->setTitle('t5');
$article5->save();

$t->diag('sfDoctrineFinderPager');

$pager = new sfDoctrineFinderPager('DArticle', 2);
$pager->setPage(1);
$pager->init();

$t->is($pager->getNbResults(), 5, 'sfDoctrineFinderPager::getNbResults() return the total nb of results');
$t->is($pager->getLastPage(), 3, 'sfDoctrineFinderPager::getLastPage() return the total nb of pages');
$t->is($pager->getFirstIndice(), 1, 'sfDoctrineFinderPager::getFirstIndice() return offset of the first result of the page');
$articles = $pager->getResults();
$t->is(count($articles), 2, 'sfDoctrineFinderPager::getResults() return an array of max $maxPerPage results');
$t->is(@$articles[0]->getTitle(), 'tt1', 'sfDoctrineFinderPager::getResults() return an array of BaseObject instances');
$t->is(@$articles[1]->getTitle(), 'tt2', 'sfDoctrineFinderPager::getResults() return an array of BaseObject instances');

$pager = new sfDoctrineFinderPager('DArticle', 2);
$pager->setPage(2);
$pager->init();

$t->is($pager->getNbResults(), 5, 'sfDoctrineFinderPager::getNbResults() return the total nb of results');
$t->is($pager->getLastPage(), 3, 'sfDoctrineFinderPager::getLastPage() return the total nb of pages');
$t->is($pager->getFirstIndice(), 3, 'sfDoctrineFinderPager::getFirstIndice() return offset of the first result of the page');
$articles = $pager->getResults();
$t->is(count($articles), 2, 'sfDoctrineFinderPager::getResults() return an array of max $maxPerPage results');
$t->is(@$articles[0]->getTitle(), 'tt3', 'sfDoctrineFinderPager::getResults() return an array of BaseObject instances');
$t->is(@$articles[1]->getTitle(), 'tt4', 'sfDoctrineFinderPager::getResults() return an array of BaseObject instances');

$pager = new sfDoctrineFinderPager('DArticle', 2);
$pager->setPage(3);
$pager->init();

$t->is($pager->getNbResults(), 5, 'sfDoctrineFinderPager::getNbResults() return the total nb of results');
$t->is($pager->getLastPage(), 3, 'sfDoctrineFinderPager::getLastPage() return the total nb of pages');
$t->is($pager->getFirstIndice(), 5, 'sfDoctrineFinderPager::getFirstIndice() return offset of the first result of the page');
$articles = $pager->getResults();
$t->is(count($articles), 1, 'sfDoctrineFinderPager::getResults() return an array of max $maxPerPage results');
$t->is(@$articles[0]->getTitle(), 't5', 'sfDoctrineFinderPager::getResults() return an array of BaseObject instances');

$pager = new sfDoctrineFinderPager('DArticle', 2);
$finder = sfDoctrineFinder::from('DArticle')->
  where('Title', 'foo')->
  where('CategoryId', 1);
$pager->setFinder($finder);
$pager->init();
if (Doctrine::VERSION == '0.11.0')
{
  $t->is($finder->getLatestQuery(), 'SELECT COUNT(DISTINCT d.id) AS num_results FROM d_article d WHERE (d.title = \'foo\' AND d.category_id = \'1\') GROUP BY d.id' , 'sfDoctrineFinderPager::init() issues a COUNT DISTINCT query with the correct WHERE conditions');
}
else
{
  echo Doctrine::VERSION, "\n";
  $t->is($finder->getLatestQuery(), 'SELECT COUNT(*) AS num_results FROM d_article d WHERE (d.title = \'foo\' AND d.category_id = \'1\')' , 'sfDoctrineFinderPager::init() issues a COUNT query with the correct WHERE conditions');
}

$t->diag('sfDoctrineFinder::paginate()');

$pager = sfDoctrineFinder::from('DArticle')->
  paginate(1, 2);
  
$t->isa_ok($pager, 'sfDoctrineFinderPager', 'sfDoctrineFinder::paginate() returns a sfDoctrineFinderPager object');
$t->ok($pager instanceof sfDoctrinePager, 'sfDoctrineFinder::paginate() returns an object extending sfDoctrinePager');
$t->is($pager->getNbResults(), 5, 'sfDoctrineFinder::paginate() returns an initialized pager object');
$t->is($pager->getLastPage(), 3, 'sfDoctrineFinder::paginate() returns an initialized pager object');
$t->is($pager->getFirstIndice(), 1, 'sfDoctrineFinder::paginate() returns an initialized pager object');
$articles = $pager->getResults();
$t->is(count($articles), 2, 'sfDoctrineFinder::paginate() returns a pager object from which items can be retrieved');
$t->isa_ok(@$articles[0], 'DArticle', 'sfDoctrineFinder::paginate() returns a pager object from which items can be retrieved');

$pager = sfDoctrineFinder::from('DArticle')->
  where('Title', 'like', 'tt%')->
  paginate(1, 2);
  
$t->is($pager->getNbResults(), 4, 'sfDoctrineFinder::paginate() sfDoctrineFinder::paginate() uses the internal conditions');
$t->is($pager->getLastPage(), 2, 'sfDoctrineFinder::paginate() sfDoctrineFinder::paginate() uses the internal conditions');
$t->is($pager->getFirstIndice(), 1, 'sfDoctrineFinder::paginate() sfDoctrineFinder::paginate() uses the internal conditions');

$t->diag('sfDoctrineFinderPager issues with GroupBy');
$finder = sfDoctrineFinder::from('DArticle')->groupBy('Title');
$pager = new sfDoctrineFinderPager('DArticle', 2);
$pager->setFinder($finder);
$pager->init();
//$t->is($finder->getLatestQuery(), 'SELECT COUNT(DISTINCT d.id) AS num_results FROM d_article d', 'sfDoctrineFinderPager::init() removes groupBy clauses and issues a count()');
$t->skip('sfDoctrineFinderPager::init() removes groupBy clauses and issues a count() (bug in sfDoctrinePager)');
$pager->getResults();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d GROUP BY d.title LIMIT 2', 'sfDoctrineFinderPager::getResults() does not remove groupBy clauses and issues a select()');

$t->diag('sfDoctrineFinderPager issues with object finders classes');
class DArticleFinder extends sfDoctrineFinder
{
  protected $class = 'DArticle';
}
$finder = new DArticleFinder();
try
{
  $pager = $finder->paginate();
  $t->pass('Children of sfDoctrineFinder can use paginate()');
}
catch(sfException $e)
{
  $t->fail('Children of sfDoctrineFinder can use paginate()');
}

$t->diag('sfDoctrineFinderPager issues with repeated criterions');

$finder = sfDoctrineFinder::from('DArticle')->
  where('Title', 'foo')->
  where('CategoryId', 1);
$pager = $finder->paginate(2, 1);
$results = $pager->getResults();
$t->is(
  substr($finder->getLatestQuery(), 0, 139),
  "SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d WHERE (d.title = 'foo' AND d.category_id = '1')",
  'getResults() does not repeat conditions'
);

$t->diag('sfDoctrineFinderPager issues with symfony cache');

try
{
  serialize($pager);
  $t->pass('A pager can be serialized');
}
catch(Exception $e)
{
  $t->fail('A pager can be serialized');
}