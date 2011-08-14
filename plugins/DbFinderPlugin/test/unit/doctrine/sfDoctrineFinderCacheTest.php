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

    connection:    doctrine
    DArticle:
      columns:
        title:       string(255)
        category_id: integer
      relations:
        Category:
          class:    DCategory
          local:    category_id
          type:     one
          foreign:  id
          foreignAlias: DArticles
    DCategory:
      columns:
        name:        string(255)
    DComment:
      columns:
        content:     string(255)
        DArticle_id:  integer
        author_id:   integer

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(21, new lime_output_color());

$t->diag('getUniqueIdentifier()');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'foo')->getUniqueIdentifier();
$t->is($id1, $id2, 'Similar queries get the same unique identifier');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'bar')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'Different queries get a different unique identifier');

$id1 = DbFinder::from('DArticle')->getUniqueIdentifier();
$id2 = DbFinder::from('DComment')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes main model class into account');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->with('DCategory')->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'foo')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes with classes into account');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->withColumn('DCategory.Name')->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'foo')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes with columns into account');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->leftJoin('Category')->withColumn('DCategory.Name')->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'foo')->withColumn('DCategory.Name')->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes joins into account');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->where('DCategory.Id', 1)->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'foo')->orWhere('DCategory.Id', 1)->getUniqueIdentifier();
$t->isnt($id1, $id2, 'unique identifier takes logic combinators into account');

$id1 = DbFinder::from('DArticle')->where('Title', 'foo')->where('Id', '=', 1, 'temp')->getUniqueIdentifier();
$id2 = DbFinder::from('DArticle')->where('Title', 'foo')->getUniqueIdentifier();
$t->is($id1, $id2, 'unique identifier does not take uncombined conditions into account');

if (Doctrine::VERSION == '0.11.0')
{
  $t->skip('Query cache does not work with Doctrine 0.11', 13);
  die();
}

$cache = new Doctrine_Cache_Apc();

$t->diag('useCache()');

// Simple queries

apc_clear_cache('user');

$finder = DbFinder::from('DArticle')->where('Title', 'foo')->useCache($cache, 10);
$finder->findOne();
$SQL1 = $finder->getLatestQuery(); // SELECT * FROM article WHERE article.title = 'foo' LIMIT 1
$finder = DbFinder::from('DArticle')->where('Title', 'bar')->useCache($cache, 10);
$finder->findOne();
$SQL2 = $finder->getLatestQuery(); // SELECT * FROM article WHERE article.title = 'bar' LIMIT 1
$t->isnt($SQL1, $SQL2, 'Uncached finder queries trigger SQL queries');
$finder = DbFinder::from('DArticle')->where('Title', 'foo')->useCache($cache, 10);
$finder->findOne();
$SQL3 = $finder->getLatestQuery(); // Using cache, so no new query: SELECT * FROM article WHERE article.title = 'bar' LIMIT 1
$t->is($SQL3, $SQL2, 'Cached finder queries do not trigger SQL queries');

// Count queries

apc_clear_cache('user');

$finder = DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo')->with('DCategory');
$finder->count();
$SQL1 = $finder->getLatestQuery();
$finder = DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'bar')->with('DCategory');
$finder->count();
$SQL2 = $finder->getLatestQuery();
$t->isnt($SQL1, $SQL2, 'Uncached count finder queries trigger SQL queries');
$finder = DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo')->with('DCategory');
$finder->count();
$SQL3 = $finder->getLatestQuery();
// Doctrine bug prevents count queries from being cached
// See http://trac.doctrine-project.org/ticket/1561
//$t->is($SQL3, $SQL2, 'Cached count finder queries do not trigger SQL queries');
$t->skip('Cached count finder queries do not trigger SQL queries');

// select()

$finder = DbFinder::from('DArticle')->useCache($cache, 10);
$finder->where('Title', 'foo')->select('Title')->find();
$finder->where('Title', 'bar')->find();
$SQL1 = $finder->getLatestQuery();
$finder = DbFinder::from('DArticle')->useCache($cache, 10);
$finder->where('Title', 'foo')->select('Title')->find();
$SQL2 = $finder->getLatestQuery();
$t->is($SQL1, $SQL2, 'Cached select() queries do not trigger SQL queries');

$t->diag('Cache lifetime');

// Cannot test because of PHP bug
// See http://pecl.php.net/bugs/bug.php?id=13331
$t->skip('The same query asked after the lifetime does not use the cache', 2);
/*
apc_clear_cache('user');
$finder = DbFinder::from('DArticle')->useCache($cache, 1);
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

apc_clear_cache('user');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
$article1 = new DArticle();
$article1->setTitle('foo1');
$article1->save();
$article2 = new DArticle();
$article2->setTitle('foo2');
$article2->save();

           DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo1')->findOne(); // normal query
$article = DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo1')->findOne(); // cached query
$t->isa_ok($article, 'DArticle', 'Cached finder queries return Model objects');
$t->is($article->getId(), $article1->getId(), 'find() finder queries can be cached');

      DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo1')->count(); // normal query
$nb = DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo1')->count(); // cached query
$t->is($nb, 1, 'count() finder queries can be cached');

apc_clear_cache('user');

           DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo1')->limit(1)->find(); // normal query
$article = DbFinder::from('DArticle')->useCache($cache, 10)->where('Title', 'foo1')->findOne();        // cached query
$t->isa_ok($article, 'DArticle', 'Cached queries return the correct result type');

$t->diag('useCache(true)');

apc_clear_cache('user');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
$article1 = new DArticle();
$article1->setTitle('foo1');
$article1->save();

$finder = DbFinder::from('DArticle')->useCache(true, 10);
$finder->where('Title', 'foo1')->limit(1);
$key = $finder->getQueryObject()->calculateResultCacheHash();
$t->is($cache->fetch($key), null, 'No cache is set until the query is written');
$finder->find();
$t->isnt($cache->fetch($key), null, 'useCache(true) automatically selects available cache backend');