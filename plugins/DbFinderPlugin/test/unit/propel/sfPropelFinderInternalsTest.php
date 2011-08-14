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
        category_id: ~
      article_i18n:
        content:     varchar(255)
      category:
        id:          ~
        name:        varchar(255)
      comment:
        id:          ~
        content:     varchar(255)
        article_id:  ~
        author_id:   ~
      author:
        id:          ~
        name:        varchar(255)

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

// cleanup database
ArticlePeer::doDeleteAll();

$t = new lime_test(5, new lime_output_color());

$t->diag('getColName()');

class myFinder extends sfPropelFinder
{
  public function getColName($phpName, $peerClass = null, $withPeerClass = false, $autoAddJoin = false)
  {
    return parent::getColName($phpName, $peerClass, $withPeerClass, $autoAddJoin);
  }
}
$finder = new myFinder('Article');
$t->is($finder->getColName('Title'), 'article.TITLE', 'getColName() recognizes [column phpName]');
$t->is($finder->getColName('Article_Title'), 'article.TITLE', 'getColName() recognizes [table phpName]_[column phpName]');
$t->is($finder->getColName('Article.Title'), 'article.TITLE', 'getColName() recognizes [table phpName].[column phpName]');
$t->is($finder->getColName('Article.CategoryId'), 'article.CATEGORY_ID', 'getColName() expects column names in CamelCase');
$t->is($finder->getColName('Article.categoryId'), 'article.CATEGORY_ID', 'getColName() is tolerant over the first letter capitalization');