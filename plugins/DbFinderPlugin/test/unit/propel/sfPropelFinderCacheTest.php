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
Warning: These tests will only pass if apc.enable_cli is set to 1 in php.ini for the CLI

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
      comment:
        id:          ~
        content:     varchar(255)
        article_id:  ~
        author_id:   ~

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(34, new lime_output_color());

$t->diag('getUniqueIdentifier()');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$t->is($id1, $id2, 'Similar queries get the same unique identifier');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'bar')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'Different queries get a different unique identifier');

$id1 = DbFinder::from('Article')->getUniqueIdentifier();
$id2 = DbFinder::from('Comment')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes main model class into account');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->with('Category')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes with classes into account');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->withColumn('Category.Name')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes with columns into account');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->leftJoin('Category')->withColumn('Category.Name')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->withColumn('Category.Name')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes joins into account');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->where('Category.Id', 1)->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->orWhere('Category.Id', 1)->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes logic combinators into account');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->where('Id', '=', 1, 'temp')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$t->is($id1, $id2, 'unique identifier does not take uncombined conditions into account');

$id1 = DbFinder::from('Article')->where('Title', 'foo')->getUniqueIdentifier();
$id2 = DbFinder::from('Article')->where('Title', 'foo')->select('Title')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes selected columns into account');

sfConfig::set('sf_use_process_cache', true);
if(!class_exists('sfProcessCache'))
{
  // so this is symfony 1.1
  class sfProcessCache
  {
    protected $cache;
    public function __construct()
    {
      $this->cache = new sfAPCCache();
      $this->cache->initialize();
    }
    
    public function set($key, $value, $lifeTime = 0)
    {
      return $this->cache->set($key, $value, $lifeTime = 0);
    }

    public function get($key)
    {
      return $this->cache->get($key);
    }

    public function has($key)
    {
      return $this->cache->has($key);
    }

    public function clear()
    {
      return $this->cache->clean();
    }
  }
}


$cache = new sfProcessCache();

$t->diag('useCache()');

// Simple queries

$cache->clear();

$finder = DbFinder::from('Article');
$finder = $finder->where('Title', 'foo')->limit(1);
$key = $finder->getUniqueIdentifier();
$finder->findOne();
$t->is($cache->get($key), null, 'No cache is set until the cache is enabled');
$finder = $finder->where('Title', 'foo')->limit(1)->useCache($cache, 10);
$finder->findOne();
$t->isnt($cache->get($key), null, 'useCache() activates query caching on simple find() queries');
$SQL1 = $finder->getLatestQuery(); // SELECT * FROM article WHERE article.title = 'foo' LIMIT 1
$finder->where('Title', 'bar')->findOne();
$SQL2 = $finder->getLatestQuery(); // SELECT * FROM article WHERE article.title = 'bar' LIMIT 1
$t->isnt($SQL1, $SQL2, 'Uncached finder queries trigger SQL queries');
$finder->where('Title', 'foo')->findOne();
$SQL3 = $finder->getLatestQuery(); // Using cache, so no new query: SELECT * FROM article WHERE article.title = 'bar' LIMIT 1
$t->is($SQL3, $SQL2, 'Cached finder queries do not trigger SQL queries');
$finder->useCache(false);
$finder->where('Title', 'foo')->findOne();
$SQL4 = $finder->getLatestQuery(); // Not using cache, so new query: SELECT * FROM article WHERE article.title = 'foo' LIMIT 1
$t->isnt($SQL4, $SQL2, 'Setting cache to false deactivates the cache');

// Complex queries

$cache->clear();

$finder = DbFinder::from('Article')->useCache($cache, 10);
$finder = $finder->where('Title', 'foo')->with('Category');
$key = $finder->getUniqueIdentifier();
$t->is($cache->get($key), null, 'No cache is set until the query is executed');
$finder->find();
$t->isnt($cache->get($key), null, 'useCache() activates query caching on complex find() queries');
$finder->where('Title', 'bar')->find();
$SQL1 = $finder->getLatestQuery();
$finder->where('Title', 'foo')->with('Category')->find();
$SQL2 = $finder->getLatestQuery();
$t->is($SQL1, $SQL2, 'Cached complex queries do not trigger SQL queries');

// Count queries

$cache->clear();

$finder = DbFinder::from('Article')->useCache($cache, 10);
$finder = $finder->where('Title', 'foo')->with('Category');
$key = $finder->getUniqueIdentifier();
$t->is($cache->get($key.'_count'), null, 'No cache is set until the query is executed');
$finder->count();
$t->cmp_ok($cache->get($key.'_count'), '!==', null, 'useCache() activates query caching on count() queries');
$finder->where('Title', 'bar')->find();
$SQL1 = $finder->getLatestQuery();
$finder->where('Title', 'foo')->with('Category')->count();
$SQL2 = $finder->getLatestQuery();
$t->is($SQL1, $SQL2, 'Cached count queries do not trigger SQL queries');

// select()

$finder = DbFinder::from('Article')->useCache($cache, 10);
$finder = $finder->where('Title', 'foo')->select('Title');
$key = $finder->getUniqueIdentifier();
$t->is($cache->get($key), null, 'No cache is set until the query is executed');
$finder->find();
$t->cmp_ok($cache->get($key), '!==', null, 'useCache() activates query caching on find() queries called after select()');
$finder->where('Title', 'bar')->find();
$SQL1 = $finder->getLatestQuery();
$finder->where('Title', 'foo')->select('Title')->find();
$SQL2 = $finder->getLatestQuery();
$t->is($SQL1, $SQL2, 'Cached select() queries do not trigger SQL queries');


$t->diag('sfPropelFinderCache::justUsedCache()');

$cache->clear();

$DbFinderCache = new sfPropelFinderCache($cache, 10);
$finder = DbFinder::from('Article')->useCache($DbFinderCache, 10);
$finder->where('Title', 'foo')->findOne();
$t->is($DbFinderCache->justUsedCache(), false, 'justUsedCache() returns false when the query has been executed');
$finder->where('Title', 'foo')->findOne();
$t->is($DbFinderCache->justUsedCache(), true, 'justUsedCache() returns true when the query has not been executed');
$finder->where('Title', 'bar')->findOne();
$t->is($DbFinderCache->justUsedCache(), false, 'justUsedCache() returns false when the query has been executed');

$t->diag('Cache lifetime');

// Cannot test because of PHP bug
// See http://pecl.php.net/bugs/bug.php?id=13331
$t->skip('The same query asked after the lifetime does not use the cache', 2);
/*
$cache->clear();
$finder = DbFinder::from('Article')->useCache($cache, 1);
$finder->where('Title', 'foo')->findOne(); // write cache 1
$finder->where('Title', 'bar')->findOne(); // write cache 2
$SQL1 = $finder->getLatestQuery();
$finder->where('Title', 'foo')->findOne(); // read cache 1
$SQL2 = $finder->getLatestQuery();
$t->is($SQL1, $SQL2, 'The same query asked within the lifetime uses the cache');
sleep(2);
$finder->where('Title', 'foo')->findOne(); // re-write cache 1
$SQL3 = $finder->getLatestQuery();
$t->isnt($SQL1, $SQL3, 'The same query asked after the lifetime does not use the cache');
*/

$t->diag('Cached results');

$cache->clear();

ArticlePeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('foo1');
$article1->save();
$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$finder = DbFinder::from('Article')->useCache($cache, 10);
           $finder->where('Title', 'foo1')->findOne(); // normal query
$article = $finder->where('Title', 'foo1')->findOne(); // cached query
$t->isa_ok($article, 'Article', 'Cached finder queries return Model objects');
$t->is($article->getId(), $article1->getId(), 'find() finder queries can be cached');
      $finder->where('Title', 'foo1')->count(); // normal query
$nb = $finder->where('Title', 'foo1')->count(); // cached query
$t->is($nb, 1, 'count() finder queries can be cached');

$cache->clear();

$finder = DbFinder::from('Article')->useCache($cache, 10);
           $finder->where('Title', 'foo1')->limit(1)->find(); // normal query
$article = $finder->where('Title', 'foo1')->findOne();        // cached query
$t->isa_ok($article, 'Article', 'Cached queries return the correct result type');

$t->diag('useCache(true)');

$cache->clear();

$finder = DbFinder::from('Article')->useCache(true, 10);
$finder->where('Title', 'foo1')->limit(1);
$key = $finder->getUniqueIdentifier();
$t->is($cache->get($key), null, 'No cache is set until the query is written');
$finder->find();
$t->isnt($cache->get($key), null, 'useCache(true) automatically selects available cache backend');