<?php
/*
 * This file is part of the sfPropelFinder package.
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
      article:
        id:          ~
        title:       varchar(255)

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$con = Propel::getConnection();

// cleanup database
AuthorPeer::doDeleteAll();
CommentPeer::doDeleteAll();
CategoryPeer::doDeleteAll();
ArticlePeer::doDeleteAll();

$t = new lime_test(33, new lime_output_color());

$article1 = new Article();
$article1->setTitle('tt1');
$article1->save();
$article2 = new Article();
$article2->setTitle('tt2');
$article2->save();
$article3 = new Article();
$article3->setTitle('tt3');
$article3->save();
$article4 = new Article();
$article4->setTitle('tt4');
$article4->save();
$article5 = new Article();
$article5->setTitle('t5');
$article5->save();

$t->diag('sfPropelFinderPager');

$pager = new sfPropelFinderPager('Article', 2);
$pager->setPage(1);
$pager->init();

$t->is($pager->getNbResults(), 5, 'sfPropelFinderPager::getNbResults() return the total nb of results');
$t->is($pager->getLastPage(), 3, 'sfPropelFinderPager::getLastPage() return the total nb of pages');
$t->is($pager->getFirstIndice(), 1, 'sfPropelFinderPager::getFirstIndice() return offset of the first result of the page');
$articles = $pager->getResults();
$t->is(count($articles), 2, 'sfPropelFinderPager::getResults() return an array of max $maxPerPage results');
$t->is(@$articles[0]->getTitle(), 'tt1', 'sfPropelFinderPager::getResults() return an array of BaseObject instances');
$t->is(@$articles[1]->getTitle(), 'tt2', 'sfPropelFinderPager::getResults() return an array of BaseObject instances');

$pager = new sfPropelFinderPager('Article', 2);
$pager->setPage(2);
$pager->init();

$t->is($pager->getNbResults(), 5, 'sfPropelFinderPager::getNbResults() return the total nb of results');
$t->is($pager->getLastPage(), 3, 'sfPropelFinderPager::getLastPage() return the total nb of pages');
$t->is($pager->getFirstIndice(), 3, 'sfPropelFinderPager::getFirstIndice() return offset of the first result of the page');
$articles = $pager->getResults();
$t->is(count($articles), 2, 'sfPropelFinderPager::getResults() return an array of max $maxPerPage results');
$t->is(@$articles[0]->getTitle(), 'tt3', 'sfPropelFinderPager::getResults() return an array of BaseObject instances');
$t->is(@$articles[1]->getTitle(), 'tt4', 'sfPropelFinderPager::getResults() return an array of BaseObject instances');

$pager = new sfPropelFinderPager('Article', 2);
$pager->setPage(3);
$pager->init();

$t->is($pager->getNbResults(), 5, 'sfPropelFinderPager::getNbResults() return the total nb of results');
$t->is($pager->getLastPage(), 3, 'sfPropelFinderPager::getLastPage() return the total nb of pages');
$t->is($pager->getFirstIndice(), 5, 'sfPropelFinderPager::getFirstIndice() return offset of the first result of the page');
$articles = $pager->getResults();
$t->is(count($articles), 1, 'sfPropelFinderPager::getResults() return an array of max $maxPerPage results');
$t->is(@$articles[0]->getTitle(), 't5', 'sfPropelFinderPager::getResults() return an array of BaseObject instances');

$pager = new sfPropelFinderPager('Article', 2);
$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  where('CategoryId', 1);
$pager->setFinder($finder);
$pager->init();
$t->is($con->getLastExecutedQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article WHERE (article.TITLE=\'foo\' AND article.CATEGORY_ID=1)'), 'sfPropelFinderPager::init() issues a COUNT query with the correct WHERE conditions');

$t->diag('sfPropelFinder::paginate()');

$pager = sfPropelFinder::from('Article')->
  paginate(1, 2);
  
$t->isa_ok($pager, 'sfPropelFinderPager', 'sfPropelFinder::paginate() returns a sfPropelFinderPager object');
$t->ok($pager instanceof sfPropelPager, 'sfPropelFinder::paginate() returns an object extending sfPropelPager');
$t->is($pager->getNbResults(), 5, 'sfPropelFinder::paginate() returns an initialized pager object');
$t->is($pager->getLastPage(), 3, 'sfPropelFinder::paginate() returns an initialized pager object');
$t->is($pager->getFirstIndice(), 1, 'sfPropelFinder::paginate() returns an initialized pager object');
$articles = $pager->getResults();
$t->is(count($articles), 2, 'sfPropelFinder::paginate() returns a pager object from which items can be retrieved');
$t->isa_ok(@$articles[0], 'Article', 'sfPropelFinder::paginate() returns a pager object from which items can be retrieved');

$pager = sfPropelFinder::from('Article')->
  where('Title', 'like', 'tt%')->
  paginate(1, 2);
  
$t->is($pager->getNbResults(), 4, 'sfPropelFinder::paginate() sfPropelFinder::paginate() uses the internal conditions');
$t->is($pager->getLastPage(), 2, 'sfPropelFinder::paginate() sfPropelFinder::paginate() uses the internal conditions');
$t->is($pager->getFirstIndice(), 1, 'sfPropelFinder::paginate() sfPropelFinder::paginate() uses the internal conditions');

$t->diag('sfPropelFinderPager issues with GroupBy');
$finder = sfPropelFinder::from('Article')->groupBy('Title');
$pager = new sfPropelFinderPager('Article', 2);
$pager->setFinder($finder);
$pager->init();
$t->is($con->getLastExecutedQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article'), 'sfPropelFinderPager::init() removes groupBy clauses and issues a COUNT');
$pager->getResults();
$t->is($con->getLastExecutedQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article GROUP BY article.TITLE LIMIT 2', 'sfPropelFinderPager::getResults() does not remove groupBy clauses and issues a SELECT');

$t->diag('sfPropelFinderPager issues with object finders classes');
class ArticleFinder extends sfPropelFinder
{
  protected $class = 'Article';
}
$finder = new ArticleFinder();
try
{
  $pager = $finder->paginate();
  $t->pass('Children of sfPropelFinder can use paginate()');
}
catch(sfException $e)
{
  $t->fail('Children of sfPropelFinder can use paginate()');
}

$t->diag('sfPropelFinderPager issues with repeated criterions');

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  where('CategoryId', 1);
$pager = $finder->paginate(2, 1);
$results = $pager->getResults();
$t->is(
  $finder->getLatestQuery(),
  "SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article WHERE (article.TITLE='foo' AND article.CATEGORY_ID=1) LIMIT 1",
  'getResults() does not repeat conditions'
);

$t->diag('sfPropelFinderPager issues with symfony cache');

try
{
  serialize($pager);
  $t->pass('A pager can be serialized');
}
catch(Exception $e)
{
  $t->fail('A pager can be serialized');
}