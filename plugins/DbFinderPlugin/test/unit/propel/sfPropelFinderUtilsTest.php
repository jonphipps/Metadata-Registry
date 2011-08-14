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

$t = new lime_test(3, new lime_output_color());

$t->diag('sfPropelFinderUtils::getColNameUsingAlias()');

$col = sfPropelFinderUtils::getColNameUsingAlias('foo', 'Title', 'Article');
$t->is($col, 'foo.TITLE', 'getColNameUsingAlias() returns the correct colname when the columnname is simple');
$col = sfPropelFinderUtils::getColNameUsingAlias('c', 'ArticleId', 'Comment');
$t->is($col, 'c.ARTICLE_ID', 'getColNameUsingAlias() returns the correct colname when the column name is CamelCased');
$col = sfPropelFinderUtils::getColNameUsingAlias('Comment', 'ArticleId', 'Comment');
$t->is($col, 'Comment.ARTICLE_ID', 'getColNameUsingAlias() returns the correct colname even when the alias and the main class are the same');
