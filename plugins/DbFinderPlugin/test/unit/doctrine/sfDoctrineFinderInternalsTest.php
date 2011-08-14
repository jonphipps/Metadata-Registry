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

$t = new lime_test(7, new lime_output_color());

$t->diag('getColName()');

class myFinder extends sfDoctrineFinder
{
  public function getColName($phpName, $class = null, $detail = false, $autoAddJoin = false)
  {
    return parent::getColName($phpName, $class, $detail, $autoAddJoin);
  }
}
$finder = new myFinder('DArticle');
$t->is($finder->getColName('Title'), 'DArticle.title', 'getColName() recognizes [column phpName]');
$t->is($finder->getColName('DArticle_Title'), 'DArticle.title', 'getColName() recognizes [table phpName]_[column phpName]');
$t->is($finder->getColName('DArticle.Title'), 'DArticle.title', 'getColName() recognizes [table phpName].[column phpName]');
$t->is($finder->getColName('DArticle.CategoryId'), 'DArticle.category_id', 'getColName() expects column names in CamelCase');
$t->is($finder->getColName('DArticle.categoryId'), 'DArticle.category_id', 'getColName() is tolerant over the first letter capitalization');
$t->is($finder->getColName('d.Title'), 'd.title', 'getColName() recognizes [table alias].[column phpName]');

$finder = new myFinder('DArticle b');
$t->is($finder->getColName('b.Title'), 'b.title', 'getColName() recognizes [table alias].[column phpName]');