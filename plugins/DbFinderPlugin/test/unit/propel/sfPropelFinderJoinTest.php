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

And a second model similar to:

    propel:
      _attributes: { package: lib.model.relations }
      sex:
        _attributes: { phpName: Civility }
        is_man:      boolean
      club:
        code:        varchar(100)
      club_i18n:
        motto:       varchar(255)
      person:
        id:          ~
        name:        varchar(255)
        foo:         { type: integer, foreignTable: club, foreignReference: id, onDelete: cascade }
        the_sex:     { type: integer, foreignTable: sex, foreignReference: id, onDelete: cascade }
        
      human:
        id:
        name: varchar(255)
        father_id: { type: integer, foreignTable: human, foreignReference: id }
        mother_id: { type: integer, foreignTable: human, foreignReference: id }

      house:
        id:
        name: varchar(255)
        owner_id: { type: integer, foreignTable: human, foreignReference: id }
        renter_id: { type: integer, foreignTable: human, foreignReference: id }

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(93, new lime_output_color());

/********************************/
/* sfPropelFinder::join($class) */
/********************************/

$t->diag('sfPropelFinder::join($class)');

$finder = sfPropelFinder::from('Article')->join('Comment');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), Criteria::INNER_JOIN, 'join() ends up in an inner join');
$t->is($join->getLeftColumnName(), 'ID', 'join($class) guesses the left column name');
$t->is($join->getLeftTableName(), 'article', 'join($class) guesses the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'join($class) guesses the right column name');
$t->is($join->getRightTableName(), 'comment', 'join($class) guesses the right table name');

/****************************************/
/* sfPropelFinder::join($classAndAlias) */
/****************************************/

$t->diag('sfPropelFinder::join($classAndAlias)');

$finder = sfPropelFinder::from('Article')->join('Comment c');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), Criteria::INNER_JOIN, 'join(classAndAlias) ends up in an inner join (one-to-many)');
$t->is($join->getLeftColumnName(), 'ID', 'join($classAndAlias) guesses the left column name');
$t->is($join->getLeftTableName(), 'article', 'join($classAndAlias) guesses the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'join($classAndAlias) guesses the right column name');
$t->is($join->getRightTableName(), 'c', 'join($classAndAlias) uses the alias for the right table name');

$finder = sfPropelFinder::from('Comment')->join('Article a');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), Criteria::INNER_JOIN, 'join(classAndAlias) ends up in an inner join (one-to-many)');
$t->is($join->getLeftColumnName(), 'ARTICLE_ID', 'join($classAndAlias) guesses the left column name');
$t->is($join->getLeftTableName(), 'comment', 'join($classAndAlias) guesses the left table name');
$t->is($join->getRightColumnName(), 'ID', 'join($classAndAlias) guesses the right column name');
$t->is($join->getRightTableName(), 'a', 'join($classAndAlias) uses the alias for the right table name');

/***************************************/
/* sfPropelFinder::join($class, $type) */
/***************************************/

$t->diag('sfPropelFinder::join($class, $type)');

$finder = sfPropelFinder::from('Article')->join('Comment', Criteria::LEFT_JOIN);
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'join($class, $type) creates a typed join (with $type like Criteria::LEFT_JOIN)');

$finder = sfPropelFinder::from('Article')->join('Comment', 'left join');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'join($class, $type) creates a typed join (with $type like "left join")');

$finder = sfPropelFinder::from('Article')->join('Comment', 'left');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'join($class, $type) creates a typed join (with $type like "left")');

$t->is($join->getLeftColumnName(), 'ID', 'join($class, $type) guesses the left column name');
$t->is($join->getLeftTableName(), 'article', 'join($class, $type) guesses the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'join($class, $type) guesses the right column name');
$t->is($join->getRightTableName(), 'comment', 'join($class, $type) guesses the right table name');

/*********************************************/
/* sfPropelFinder::join($start, $end, $type) */
/*********************************************/

$t->diag('sfPropelFinder::join($start, $end, $type)');

$finder = sfPropelFinder::from('Article')->join('Article.Id', 'Comment.ArticleId', Criteria::LEFT_JOIN);
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'join($start, $end, $type) creates a typed join');
$t->is($join->getLeftColumnName(), 'ID', 'join($start, $end, $type) converts the left column name');
$t->is($join->getLeftTableName(), 'article', 'join($start, $end, $type) converts the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'join($start, $end, $type) converts the right column name');
$t->is($join->getRightTableName(), 'comment', 'join($start, $end, $type) converts the right table name');

/*************************************************************/
/* sfPropelFinder::join($classAndAlias, $start, $end, $type) */
/*************************************************************/

$t->diag('sfPropelFinder::join($classAndAlias, $start, $end, $type)');

$finder = sfPropelFinder::from('Article')->join('Comment c', 'Article.Id', 'c.ArticleId', Criteria::LEFT_JOIN);
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'join($classAndAlias, $start, $end, $type) creates a typed join');
$t->is($join->getLeftColumnName(), 'ID', 'join($classAndAlias, $start, $end, $type) converts the left column name');
$t->is($join->getLeftTableName(), 'article', 'join($classAndAlias, $start, $end, $type) converts the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'join($classAndAlias, $start, $end, $type) converts the right column name');
$t->is($join->getRightTableName(), 'c', 'join($classAndAlias, $start, $end, $type) converts the right table name using the provided alias');

/****************************************/
/* leftJoin(), rightJoin(), innerJoin() */
/****************************************/

$t->diag('leftJoin(), rightJoin(), innerJoin()');

$finder = sfPropelFinder::from('Article')->leftJoin('Comment');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'leftJoin($class) ends up in a left join');
$finder = sfPropelFinder::from('Article')->rightJoin('Comment');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'RIGHT JOIN', 'rightJoin($class) ends up in a right join');
$finder = sfPropelFinder::from('Article')->innerJoin('Comment');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'INNER JOIN', 'innerJoin($class) ends up in an inner join');

$finder = sfPropelFinder::from('Article')->leftJoin('Comment');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), Criteria::LEFT_JOIN, 'leftJoin($class) creates a left join');
$t->is($join->getLeftColumnName(), 'ID', 'leftJoin($class) guesses the left column name');
$t->is($join->getLeftTableName(), 'article', 'leftJoin($class) guesses the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'leftJoin($class) guesses the right column name');
$t->is($join->getRightTableName(), 'comment', 'leftJoin($class) guesses the right table name');

$finder = sfPropelFinder::from('Article')->leftJoin('Article.Id', 'Comment.ArticleId');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'leftJoin($start, $end) creates a left join');
$t->is($join->getLeftColumnName(), 'ID', 'leftJoin($start, $end) converts the left column name');
$t->is($join->getLeftTableName(), 'article', 'leftJoin($start, $end) converts the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'leftJoin($start, $end) converts the right column name');
$t->is($join->getRightTableName(), 'comment', 'leftJoin($start, $end) converts the right table name');

$finder = sfPropelFinder::from('Article')->leftJoin('Comment c', 'Article.Id', 'c.ArticleId');
$joins = $finder->getCriteria()->getJoins();
$join = array_pop($joins);
$t->is($join->getJoinType(), 'LEFT JOIN', 'leftJoin($classAndAlias, $start, $end) creates a left join');
$t->is($join->getLeftColumnName(), 'ID', 'leftJoin($classAndAlias, $start, $end) converts the left column name');
$t->is($join->getLeftTableName(), 'article', 'leftJoin($classAndAlias, $start, $end) converts the left table name');
$t->is($join->getRightColumnName(), 'ARTICLE_ID', 'leftJoin($classAndAlias, $start, $end) converts the right column name');
$t->is($join->getRightTableName(), 'c', 'leftJoin($classAndAlias, $start, $end) converts the right table name using the provided alias');

/*************************************************/
/* sfPropelFinder::join() and subsequend where() */
/*************************************************/

$t->diag('sfPropelFinder::join() and subsequend where()');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$nbArticles = sfPropelFinder::from('Article')->join('Category')->where('Category.Name', 'cat1')->count();
$t->is($nbArticles, 2, 'join() allows to join to another table (many-to-one)');
$nbArticles = sfPropelFinder::from('Article')->where('Category.Name', 'cat1')->count();
$t->is($nbArticles, 2, 'join() can be omitted if column names are explicit (many-to-one)');
$nbArticles = sfPropelFinder::from('Article')->join('Category')->where('Category.Name', 'cat2')->count();
$t->is($nbArticles, 1, 'join() allows to join to another table (many-to-one)');
$nbArticles = sfPropelFinder::from('Article')->where('Category.Name', 'cat2')->count();
$t->is($nbArticles, 1, 'join() can be omitted if column names are explicit (many-to-one)');
$article = sfPropelFinder::from('Article')->join('Category')->where('Category.Name', 'cat2')->findOne();
$t->is($article->getTitle(), 'ccccc', 'join() allows to join to another table (many-to-one)');


ArticlePeer::doDeleteAll();
CommentPeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$comment = new Comment();
$comment->setContent('foo');
$comment->setArticleId($article2->getId());
$comment->save();
$nbArticles = sfPropelFinder::from('Article')->join('Comment')->where('Comment.Content', 'foo')->count();
$t->is($nbArticles, 1, 'join() allows to join to another table (one-to-many)');
$nbArticles = sfPropelFinder::from('Article')->where('Comment.Content', 'foo')->count();
$t->is($nbArticles, 1, 'join() can be omitted if column names are explicit (one-to-many)');
$article = sfPropelFinder::from('Article')->join('Comment')->where('Comment.Content', 'foo')->findOne();
$t->is($article->getTitle(), 'bbbbb', 'join() allows to join to another table (one-to-many)');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
AuthorPeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$author1 = new Author();
$author1->setName('John');
$author1->save();
$comment = new Comment();
$comment->setContent('foo');
$comment->setArticleId($article1->getId());
$comment->setAuthor($author1);
$comment->save();
$article = sfPropelFinder::from('Article')->join('Comment')->join('Author')->where('Author.Name', 'John')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'you can chain several join() statements');
$article = sfPropelFinder::from('Article')->join('Comment')->where('Author.Name', 'John')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'join() can be omitted if column names are explicit');
$article = sfPropelFinder::from('Article')->joinComment()->joinAuthor()->where('Author.Name', 'John')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'joinXXX() does a join according to the XXX column name');

$comment = sfPropelFinder::from('Comment')->join('Article')->join('Author')->where('Author.Name', 'John')->findOne();
$t->is($comment->getContent(), 'foo', 'you can add several join() statements');
$t->is($comment->getArticle()->getTitle(), 'aaaaa', 'you can add several join() statements');
$t->is($comment->getAuthor()->getName(), 'John', 'you can add several join() statements');

/***************************************************************/
/* sfPropelFinder::join($classAndAlias) and subsequend where() */
/***************************************************************/

$t->diag('sfPropelFinder::join($classAndAlias) and subsequend where()');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$finder = sfPropelFinder::from('Article')->
  join('Category c')->
  where('c.Name', 'cat1');
$nbArticles = $finder->count();
$t->is($nbArticles, 2, 'join($classAndAlias) understands subsequent uses of the alias in where()');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE c.NAME=\'cat1\''), 'join($classAndAlias) uses the alias in the query');

/*************************************************************/
/* sfPropelFinder::join() and subsequent finder method calls */
/*************************************************************/

$t->diag('sfPropelFinder::join() and subsequent finder method calls');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$finder = sfPropelFinder::from('Article')->
  join('Category')->
  where('Category.Name', 'cat1')->
  orWhere('Category.Name', 'cat2');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) WHERE (category.NAME=\'cat1\' OR category.NAME=\'cat2\')'), 'join() allows columns of joined table to be used in orWhere()');
$finder = sfPropelFinder::from('Article')->
  join('Category')->
  whereCustom('Category.Name = ?', 'cat1');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) WHERE category.NAME = \'cat1\''), 'join() allows columns of joined table to be used in whereCustom()');
$finder = sfPropelFinder::from('Article')->
  join('Category')->
  where('Category.Name', 'cat1')->
  orWhereCustom('Category.Name = ?', 'cat2');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) WHERE (category.NAME=\'cat1\' OR category.NAME = \'cat2\')'), 'join() allows columns of joined table to be used in orWhereCustom()');
$finder = sfPropelFinder::from('Article')->
  join('Category')->
  orderBy('Category.Name');
$finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT article.ID, article.TITLE, article.CATEGORY_ID[P12, UPPER(category.NAME)] FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) ORDER BY [P12UPPER(category.NAME)][P13category.NAME] ASC'), 'join() allows columns of joined table to be used in orderBy()');
$finder = sfPropelFinder::from('Article')->
  join('Category')->
  groupBy('Category.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) GROUP BY category.NAME', 'join() allows columns of joined table to be used in groupBy()');

/***************************************************************************/
/* sfPropelFinder::join($classAndAlias) and subsequent finder method calls */
/***************************************************************************/

$t->diag('sfPropelFinder::join($classAndAlias) and subsequent finder method calls');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$finder = sfPropelFinder::from('Article')->
  join('Category c')->
  where('c.Name', 'cat1')->
  orWhere('c.Name', 'cat2');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE (c.NAME=\'cat1\' OR c.NAME=\'cat2\')'), 'join($classAndAlias) allows columns of joined table to be used in orWhere()');
$finder = sfPropelFinder::from('Article')->
  join('Category c')->
  whereCustom('c.Name = ?', 'cat1');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE c.NAME = \'cat1\''), 'join($classAndAlias) allows columns of joined table to be used in whereCustom()');
$finder = sfPropelFinder::from('Article')->
  join('Category c')->
  where('c.Name', 'cat1')->
  orWhereCustom('c.Name = ?', 'cat2');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE (c.NAME=\'cat1\' OR c.NAME = \'cat2\')'), 'join($classAndAlias) allows columns of joined table to be used in orWhereCustom()');
$finder = sfPropelFinder::from('Article')->
  join('Category c')->
  orderBy('c.Name');
$finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT article.ID, article.TITLE, article.CATEGORY_ID[P12, UPPER(c.NAME)] FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) ORDER BY [P12UPPER(c.NAME)][P13c.NAME] ASC'), 'join($classAndAlias) allows columns of joined table to be used in orderBy()');
$finder = sfPropelFinder::from('Article')->
  join('Category c')->
  groupBy('c.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) GROUP BY c.NAME', 'join($classAndAlias) allows columns of joined table to be used in groupBy()');

/************************************************************************************/
/* sfPropelFinder::join($classAndAlias, $start, $end, $type) and subsequent where() */
/************************************************************************************/

$t->diag('sfPropelFinder::join($classAndAlias, $start, $end, $type) and subsequent where()');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$finder = sfPropelFinder::from('Article')->
  join('Category c', 'Article.CategoryId', 'c.Id', 'INNER JOIN')->
  where('c.Name', 'cat1');
$nbArticles = $finder->count();
$t->is($nbArticles, 2, 'join() allows to join to another table using an alias (many-to-one)');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE c.NAME=\'cat1\''), 'join() uses aliased table names when using an alias relation');

ArticlePeer::doDeleteAll();
CommentPeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$comment = new Comment();
$comment->setContent('foo');
$comment->setArticleId($article2->getId());
$comment->save();
$finder = sfPropelFinder::from('Article')->
  join('Comment c', 'Article.Id', 'c.ArticleId', 'INNER JOIN')->
  where('c.Content', 'foo');
$nbArticles = $finder->count();
$t->is($nbArticles, 1, 'join() allows to join to another table using an alias (one-to-many)');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN comment c ON (article.ID=c.ARTICLE_ID) WHERE c.CONTENT=\'foo\''), 'join() uses aliased table names when using an alias relation');

/*************************************************************/
/* sfPropelFinder::join($classAndAlias, $start, $end, $type) and subsequent finder method calls */
/*************************************************************/

$t->diag('sfPropelFinder::join() and subsequent finder method calls');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$category2 = new Category();
$category2->setName('cat2');
$category2->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$finder = sfPropelFinder::from('Article')->
  join('Category c', 'Article.CategoryId', 'c.Id', 'INNER JOIN')->
  where('c.Name', 'cat1')->
  orWhere('c.Name', 'cat2');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE (c.NAME=\'cat1\' OR c.NAME=\'cat2\')'), 'join() using an alias allows columns of joined table to be used in orWhere()');
$finder = sfPropelFinder::from('Article')->
  join('Category c', 'Article.CategoryId', 'c.Id', 'INNER JOIN')->
  whereCustom('c.Name = ?', 'cat1');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE c.NAME = \'cat1\''), 'join() using an alias allows columns of joined table to be used in whereCustom()');
$finder = sfPropelFinder::from('Article')->
  join('Category c', 'Article.CategoryId', 'c.Id', 'INNER JOIN')->
  where('c.Name', 'cat1')->
  orWhereCustom('c.Name = ?', 'cat2');
$finder->count();
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12article.ID]) FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) WHERE (c.NAME=\'cat1\' OR c.NAME = \'cat2\')'), 'join() using an alias allows columns of joined table to be used in orWhereCustom()');
$finder = sfPropelFinder::from('Article')->
  join('Category c', 'Article.CategoryId', 'c.Id', 'INNER JOIN')->
  orderBy('c.Name');
$finder->find();
$t->is($finder->getLatestQuery(), propel_sql('SELECT article.ID, article.TITLE, article.CATEGORY_ID[P12, UPPER(c.NAME)] FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) ORDER BY [P12UPPER(c.NAME)][P13c.NAME] ASC'), 'join() using an alias allows columns of joined table to be used in orderBy()');
$finder = sfPropelFinder::from('Article')->
  join('Category c', 'Article.CategoryId', 'c.Id', 'INNER JOIN')->
  groupBy('c.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article INNER JOIN category c ON (article.CATEGORY_ID=c.ID) GROUP BY c.NAME', 'join() using an alias allows columns of joined table to be used in groupBy()');

/***********************************************************************/
/* sfPropelFinder::join() with multiple foreign keys to the same table */
/***********************************************************************/

$t->diag('sfPropelFinder::join() with multiple foreign keys to the same table');

HumanPeer::doDeleteAll();
HousePeer::doDeleteAll();
$human1 = new Human();
$human1->setName('John');
$human1->save();
$human2 = new Human();
$human2->setName('Jane');
$human2->save();
$house1 = new House();
$house1->setName('Home1');
$house1->setHumanRelatedByOwnerId($human1);
$house1->setHumanRelatedByRenterId($human2);
$house1->save();
$house2 = new House();
$house2->setName('Home2');
$house2->setHumanRelatedByOwnerId($human2);
$house2->setHumanRelatedByRenterId($human1);
$house2->save();
$finder = sfPropelFinder::from('House')->
  join('Human owner', 'House.OwnerId', 'owner.Id', 'INNER JOIN')->
  where('owner.Name', 'John');
$nbHouses = $finder->count();
$t->is($nbHouses, 1, 'join() allows to join to another table with several foreign keys using an alias');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12house.ID]) FROM house INNER JOIN human owner ON (house.OWNER_ID=owner.ID) WHERE owner.NAME=\'John\''), 'join() uses aliased table names when using an alias relation');

/************************************************************/
/* sfPropelFinder::join() with self-referenced foreign keys */
/************************************************************/

$t->diag('sfPropelFinder::join() with self-referenced foreign keys');

HumanPeer::doDeleteAll();
$human1 = new Human();
$human1->setName('John');
$human1->save();
$human2 = new Human();
$human2->setName('Albert');
$human2->setHumanRelatedByFatherId($human1);
$human2->save();

$finder = sfPropelFinder::from('Human')->
  join('Human father', 'Human.FatherId', 'father.Id', 'INNER JOIN')->
  where('father.Name', 'John');
$nbHumans = $finder->count();
$t->is($nbHumans, 1, 'join() allows to join to the current table using an alias');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12human.ID]) FROM human INNER JOIN human father ON (human.FATHER_ID=father.ID) WHERE father.NAME=\'John\''), 'join() uses aliased table names when using an alias relation');

/*********************************************************************/
/* sfPropelFinder::join() with multiple self-referenced foreign keys */
/*********************************************************************/

$t->diag('sfPropelFinder::join() with multiple self-referenced foreign keys');

HumanPeer::doDeleteAll();
$human1 = new Human();
$human1->setName('John');
$human1->save();
$human2 = new Human();
$human2->setName('Jane');
$human2->save();
$human3 = new Human();
$human3->setName('Albert');
$human3->setHumanRelatedByFatherId($human1);
$human3->setHumanRelatedByMotherId($human2);
$human3->save();

$finder = sfPropelFinder::from('Human')->
  join('Human father', 'Human.FatherId', 'father.Id', 'INNER JOIN')->
  join('Human mother', 'Human.MotherId', 'mother.Id', 'INNER JOIN')->
  where('father.Name', 'John')->
  where('mother.Name', 'Jane');
$nbHumans = $finder->count();
$t->is($nbHumans, 1, 'join() allows to join to the current table with several foreign keys using an alias');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12human.ID]) FROM human INNER JOIN human father ON (human.FATHER_ID=father.ID) INNER JOIN human mother ON (human.MOTHER_ID=mother.ID) WHERE (father.NAME=\'John\' AND mother.NAME=\'Jane\')'), 'join() uses aliased table names when using an alias relation');

HumanPeer::doDeleteAll();
$human1 = new Human();
$human1->setName('John');
$human1->save();
$human2 = new Human();
$human2->setName('Albert');
$human2->setHumanRelatedByFatherId($human1);
$human2->save();
$human3 = new Human();
$human3->setName('Jane');
$human3->setHumanRelatedByFatherId($human2);
$human3->save();

$finder = sfPropelFinder::from('Human')->
  join('Human father', 'Human.FatherId', 'father.Id', 'INNER JOIN')->
  join('Human grandfather', 'father.FatherId', 'grandfather.Id', 'INNER JOIN')->
  where('grandfather.Name', 'John');
$nbHumans = $finder->count();
$t->is($nbHumans, 1, 'join() allows to join to the current table with several foreign keys using an alias');
$t->is($finder->getLatestQuery(), propel_sql('SELECT COUNT([P13*][P12human.ID]) FROM human INNER JOIN human father ON (human.FATHER_ID=father.ID) INNER JOIN human grandfather ON (father.FATHER_ID=grandfather.ID) WHERE grandfather.NAME=\'John\''), 'join() uses aliased table names when using an alias relation');