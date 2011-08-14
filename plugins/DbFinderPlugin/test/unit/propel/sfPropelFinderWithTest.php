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

$t = new lime_test(88, new lime_output_color());

/**************************/
/* sfPropelFinder::with() */
/**************************/

$t->diag('sfPropelFinder::with()');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();
$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$sql = 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, category.ID, category.NAME FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) LIMIT 1';
$finder = sfPropelFinder::from('Article')->
  join('Category')->
  with('Category');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'with() gets the columns of the with class in addition to the columns of the current class');
$t->is($article->getTitle(), 'aaaaa', 'with() does not change the main object hyration');
$category = $article->getCategory();
$t->is($category->getName(), 'cat1', 'with() hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() avoids subsequent queries');

/*******************************************/
/* sfPropelFinder::with() without a join() */
/*******************************************/

$t->diag('sfPropelFinder::with() without a join()');

$finder = sfPropelFinder::from('Article')->
  with('Category');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'with() without a join() auto-adds missing joins in the SQL query');
$t->is($article->getTitle(), 'aaaaa', 'with() without a join() does not change the main object hyration');
$category = $article->getCategory();
$t->is($category->getName(), 'cat1', 'with() without a join() hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() without a join() avoids subsequent queries');

/************************************************/
/* sfPropelFinder::with() with a special join() */
/************************************************/

$t->diag('sfPropelFinder::with() with a special join()');

$finder = sfPropelFinder::from('Article')->
  leftJoin('Category')->
  with('Category');
$article = $finder->findOne();
$sql = 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, category.ID, category.NAME FROM article LEFT JOIN category ON (article.CATEGORY_ID=category.ID) LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'Calling a particular join() before with() changes the join clause');
$t->is($article->getTitle(), 'aaaaa', 'with() with a special join() does not change the main object hyration');
$category = $article->getCategory();
$t->is($category->getName(), 'cat1', 'with() with a special join() hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with a special join() avoids subsequent queries');

/**************************************************/
/* sfPropelFinder::with() with an explicit join() */
/**************************************************/

$t->diag('sfPropelFinder::with() with an explicit join()');

$finder = sfPropelFinder::from('Article')->
  leftJoin('Article.CategoryId', 'Category.Id')->
  with('Category');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'An explicit join() is used in the SQL query');
$t->is($article->getTitle(), 'aaaaa', 'with() with an explicit join() does not change the main object hyration');
$category = $article->getCategory();
$t->is($category->getName(), 'cat1', 'with() with an explicit join() hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with an explicit join() avoids subsequent queries');

/*************************************************/
/* sfPropelFinder::with() with an aliased join() */
/*************************************************/

$t->diag('sfPropelFinder::with() with an aliased join()');

$finder = sfPropelFinder::from('Article')->
  leftJoin('Category c')->
  with('c');
$article = $finder->findOne();
$sql = 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, c.ID, c.NAME FROM article LEFT JOIN category c ON (article.CATEGORY_ID=c.ID) LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'A join() alias is used in the SQL query');
$t->is($article->getTitle(), 'aaaaa', 'with() with an aliased join() does not change the main object hyration');
$category = $article->getCategory();
$t->is($category->getName(), 'cat1', 'with() with an aliased join() hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with an aliased join() avoids subsequent queries');

/**************************************************/
/* sfPropelFinder::with() with an explicit join() */
/**************************************************/

$t->diag('sfPropelFinder::with() with an explicit aliased join()');

$finder = sfPropelFinder::from('Article')->
  leftJoin('Category c', 'Article.CategoryId', 'c.Id')->
  with('c');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'An aliased join() is used in the SQL query');
$t->is($article->getTitle(), 'aaaaa', 'with() with an explicit aliased join() does not change the main object hyration');
$category = $article->getCategory();
$t->is($category->getName(), 'cat1', 'with() with an explicit alias join() hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with an explicit aliased join() avoids subsequent queries');


/***********************************************/
/* sfPropelFinder::with() called several times */
/***********************************************/

$t->diag('sfPropelFinder::with() called several times (a related to b, a related to c)');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
AuthorPeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('bbbbb');
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
$finder = sfPropelFinder::from('Comment')->
  with('Article')->
  with('Author');
$comment = $finder->findOne();
$sql = 'SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID, article.ID, article.TITLE, article.CATEGORY_ID, author.ID, author.NAME FROM comment INNER JOIN article ON (comment.ARTICLE_ID=article.ID) INNER JOIN author ON (comment.AUTHOR_ID=author.ID) LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'Each call to with adds the columns of a model to the SQL query');
$t->is($comment->getContent(), 'foo', 'with() called several times does not change the main object hyration');
$t->is($comment->getArticle()->getTitle(), 'bbbbb', 'with() called several times hydrates the related objects');
$t->is($comment->getAuthor()->getName(), 'John', 'with() called several times hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() called several times  avoids subsequent queries');

$t->diag('sfPropelFinder::with() called several times (a related to b, b related to c)');

$finder = sfPropelFinder::from('Comment')->
  with('Article')->
  with('Category');
$comment = $finder->findOne();
$sql = 'SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID, article.ID, article.TITLE, article.CATEGORY_ID, category.ID, category.NAME FROM comment INNER JOIN article ON (comment.ARTICLE_ID=article.ID) INNER JOIN category ON (article.CATEGORY_ID=category.ID) LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'Each call to with adds the columns of a model to the SQL query');
$t->is($comment->getContent(), 'foo', 'with() called several times does not change the main object hyration');
$t->is($comment->getArticle()->getTitle(), 'bbbbb', 'with() called several times hydrates the related objects');
$t->is($comment->getArticle()->getCategory()->getName(), 'cat1', 'with() called several times hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() called several times avoids subsequent queries');

/*************************************************************/
/* sfPropelFinder::with() called with more than one argument */
/*************************************************************/

$t->diag('sfPropelFinder::with() called with more than one argument');

$finder = sfPropelFinder::from('Comment')->with('Article', 'Category');
$comment = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'with() accepts several arguments, so you don\'t need to call it several times');

/***********************************************************************/
/* sfPropelFinder::with() with multiple foreign keys to the same table */
/***********************************************************************/

$t->diag('sfPropelFinder::with() with multiple foreign keys to the same table');

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
$finder = sfPropelFinder::from('House')->
  join('Human owner', 'House.OwnerId', 'owner.Id', 'INNER JOIN')->
  with('owner')->
  where('owner.Name', 'John');
$house = $finder->findOne();
$sql = 'SELECT house.ID, house.NAME, house.OWNER_ID, house.RENTER_ID, owner.ID, owner.NAME, owner.FATHER_ID, owner.MOTHER_ID, owner.THE_SEX FROM house INNER JOIN human owner ON (house.OWNER_ID=owner.ID) WHERE owner.NAME=\'John\' LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'with() adds the correct columns to the query when called on a foreign key to a table with more than one relation');
$t->is($house->getName(), 'Home1', 'with() with multiple foreign keys to the same table does not change the main object hyration');
$t->is($house->getHumanRelatedByOwnerId()->getName(), 'John', 'with() with multiple foreign keys to the same table hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with multiple foreign keys to the same table avoids subsequent queries');

$finder = sfPropelFinder::from('House')->
  join('Human owner', 'House.OwnerId', 'owner.Id', 'INNER JOIN')->
  join('Human renter', 'House.RenterId', 'renter.Id', 'INNER JOIN')->
  with('owner', 'renter')->
  where('owner.Name', 'John');
$house = $finder->findOne();
$sql = 'SELECT house.ID, house.NAME, house.OWNER_ID, house.RENTER_ID, owner.ID, owner.NAME, owner.FATHER_ID, owner.MOTHER_ID, owner.THE_SEX, renter.ID, renter.NAME, renter.FATHER_ID, renter.MOTHER_ID, renter.THE_SEX FROM house INNER JOIN human owner ON (house.OWNER_ID=owner.ID) INNER JOIN human renter ON (house.RENTER_ID=renter.ID) WHERE owner.NAME=\'John\' LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'with() adds the correct columns to the query when called several times on a foreign key to a table with more than one relation');
$t->is($house->getName(), 'Home1', 'with() with multiple foreign keys to the same table does not change the main object hyration');
$t->is($house->getHumanRelatedByOwnerId()->getName(), 'John', 'with() with multiple foreign keys to the same table hydrates the related objects');
$t->is($house->getHumanRelatedByRenterId()->getName(), 'Jane', 'with() with multiple foreign keys to the same table hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with multiple foreign keys to the same table avoids subsequent queries');

/************************************************************/
/* sfPropelFinder::with() with self-referenced foreign keys */
/************************************************************/

$t->diag('sfPropelFinder::with() with self-referenced foreign keys');

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
  with('father')->
  where('father.Name', 'John');
$human = $finder->findOne();
$sql = 'SELECT human.ID, human.NAME, human.FATHER_ID, human.MOTHER_ID, human.THE_SEX, father.ID, father.NAME, father.FATHER_ID, father.MOTHER_ID, father.THE_SEX FROM human INNER JOIN human father ON (human.FATHER_ID=father.ID) WHERE father.NAME=\'John\' LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'with() adds the correct columns to the query when called with self-referenced foreign keys');
$t->is($human->getName(), 'Albert', 'with() with self-referenced foreign keys does not change the main object hyration');
$t->is($human->getHumanRelatedByFatherId()->getName(), 'John', 'with() with self-referenced foreign keys hydrates the related objects');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $sql, 'with() with self-referenced foreign keys avoids subsequent queries');

/******************************/
/* sfPropelFinder::withI18n() */
/******************************/

$t->diag('sfPropelFinder::withI18n()');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
ArticleI18nPeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('aaa');
$article1->setCulture('en');
$article1->setContent('english content');
$article1->setCulture('fr');
$article1->setContent('contenu français');
$article1->save();

$baseSQL = 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, article_i18n.CONTENT, article_i18n.ID, article_i18n.CULTURE FROM article INNER JOIN article_i18n ON (article.ID=article_i18n.ID) ';
sfContext::getInstance()->getUser()->setCulture('en');
$finder = sfPropelFinder::from('Article')->
  withI18n();
$article = $finder->findOne();
$query = $baseSQL . 'WHERE article_i18n.CULTURE=\'en\' LIMIT 1';
$t->is($finder->getLatestQuery(), $query, 'withI18n() hydrates the related I18n object with a culture taken from the user object');
$t->is($article->getContent(), 'english content', 'withI18n() considers the current user culture for hydration');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $query, 'withI18n() hydrates the i18n object so that no further query is necessary');

sfContext::getInstance()->getUser()->setCulture('fr');
$finder = sfPropelFinder::from('Article')->
  withI18n();
$article = $finder->findOne();
$query = $baseSQL . 'WHERE article_i18n.CULTURE=\'fr\' LIMIT 1';
$t->is($finder->getLatestQuery(), $query, 'withI18n() hydrates the related I18n object with a culture taken from the user object');
$t->is($article->getContent(), 'contenu français', 'withI18n() considers the current user culture for hydration');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $query, 'withI18n() hydrates the i18n object so that no further query is necessary');

sfContext::getInstance()->getUser()->setCulture('fr');
$article = sfPropelFinder::from('Article')->
  withI18n('en')->
  findOne();
$t->is($article->getContent(), 'english content', 'withI18n() accepts a culture parameter to override the user culture');

sfContext::getInstance()->getUser()->setCulture('en');
$finder = sfPropelFinder::from('Article')->
  with('I18n');
$article = $finder->findOne();
$query = $baseSQL . 'WHERE article_i18n.CULTURE=\'en\' LIMIT 1';
$t->is($finder->getLatestQuery(), $query, 'with(\'I18n\') is a synonym for withI18n()');
$finder = sfPropelFinder::from('Article')->
  with('i18n');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $query, 'with(\'i18n\') is a synonym for withI18n()');

/********************************/
/* sfPropelFinder::withColumn() */
/********************************/

$t->diag('withColumn()');

ArticlePeer::doDeleteAll();
CommentPeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('bbbbb');
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

$comment = sfPropelFinder::from('Comment')->
  join('Article')->
  findOne();
try
{
  $comment->getColumn('Article.Title');
  $t->fail('getColumn() is not available as long as you don\'t add a column with withColumn()');
}
catch(Exception $e)
{
  $t->pass('getColumn() is not available as long as you don\'t add a column with withColumn()');
}

$finder = sfPropelFinder::from('Comment')->
  join('Article')->
  withColumn('Article.Title');
$comment = $finder->findOne();
$t->is($comment->getColumn('Article.Title'), 'bbbbb', 'Additional columns added with withColumn() are stored in the object and can be retrieved with getColumn()');
$t->is($finder->getLatestQuery(), 'SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID, article.TITLE AS "Article.Title" FROM comment INNER JOIN article ON (comment.ARTICLE_ID=article.ID) LIMIT 1', 'Columns added with withColumn() can contain a dot (and are then escaped with double quotes in SQL)');

$comment = sfPropelFinder::from('Comment')->
  withColumn('Article.Title')->
  findOne();
$t->is($comment->getColumn('Article.Title'), 'bbbbb', 'If withColumn() is called on a related object column with no join on this class, the finder adds the join automatically');

$comment = sfPropelFinder::from('Comment')->
  join('Article')->
  withColumn('Article.Title', 'ArticleTitle')->
  findOne();
$t->is($comment->getColumn('ArticleTitle'), 'bbbbb', 'withColumn() second parameter serves as a column alias');

if (method_exists('ColumnMap', 'getCreoleType'))
{
  // Propel1.2
  $comment = sfPropelFinder::from('Comment')->
    join('Article')->
    withColumn('Article.Title', 'ArticleTitle', 'int')->
    findOne();
  $t->is($comment->getColumn('ArticleTitle'), '0', 'withColumn() third parameter serves as a type caster (only with Propel 1.2)');
}
else
{
  $t->skip('withColumn() third parameter serves as a type caster (only with Propel 1.2)');
}

$comment = sfPropelFinder::from('Comment')->
  join('Article')->join('Author')->
  withColumn('Article.Title')->
  withColumn('Author.Name')->
  findOne();
$t->is($comment->getColumn('Article.Title'), 'bbbbb', 'withColumn() can be called several times');
$t->is($comment->getColumn('Author.Name'), 'John', 'withColumn() can be called several times');

$comment = sfPropelFinder::from('Comment')->
  join('Article')->with('Author')->
  withColumn('Article.Title')->
  findOne();
$t->is($comment->getColumn('Article.Title'), 'bbbbb', 'Columns added with withColumn() live together well with related objects added with with()');
$t->is($comment->getAuthor()->getName(), 'John', 'Related objects added with with() live together well with columns added with withColumn()');

$article = sfPropelFinder::from('Article')->
  join('Comment')->
  groupBy('Article.Id')->
  withColumn('COUNT(Comment.Id)', 'NbComments')->
  findOne();
$t->is($article->getColumn('NbComments'), '1', 'withColumn() accepts complex SQL calculations as additional column');

$finder = sfPropelFinder::from('Article')->
  join('Comment')->
  groupBy('Article.Id')->
  withColumn('COUNT(Comment.Id)', 'NbComments')->
  orderBy('NbComments');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, COUNT(comment.ID) AS NbComments FROM article INNER JOIN comment ON (article.ID=comment.ARTICLE_ID) GROUP BY article.ID ORDER BY NbComments ASC LIMIT 1', 'Columns added with withColumn() can be used for sorting');

$finder = sfPropelFinder::from('Comment')->
  join('Article a')->
  withColumn('a.Title');
$comment = $finder->findOne();
$t->is($comment->getColumn('a.Title'), 'bbbbb', 'withColumn() support table aliases');
$t->is($finder->getLatestQuery(), 'SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID, a.TITLE AS "a.Title" FROM comment INNER JOIN article a ON (comment.ARTICLE_ID=a.ID) LIMIT 1', 'Columns using a table alias added with withColumn() use the alias in the query');

$finder = sfPropelFinder::from('Article')->
  join('Comment c')->
  groupBy('Article.Id')->
  withColumn('COUNT(c.Id)', 'NbComments')->
  orderBy('NbComments');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, COUNT(c.ID) AS NbComments FROM article INNER JOIN comment c ON (article.ID=c.ARTICLE_ID) GROUP BY article.ID ORDER BY NbComments ASC LIMIT 1', 'withColumn() support table aliases in calculated columns');

/*************************************/
/* Various issues solved in the past */
/* Kept for regression testing       */
/************************************/

$t->diag('sfPropelFinder::with() issues with object finders classes');
class ArticleFinder extends sfPropelFinder
{
  protected $class = 'Article';
}

$finder = new ArticleFinder;
try
{
  $finder->join('Category')->find();
  $t->pass('Relations lookup work also on finder children objects');
}
catch (Exception $e)
{
  $t->fail('Relations lookup work also on finder children objects');
}
try
{
  $finder->with('Category')->find();
  $t->pass('Relations lookup work also on finder children objects');
}
catch (Exception $e)
{
  $t->fail('Relations lookup work also on finder children objects');
}

$t->diag('sfPropelFinder::with() and left joins');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();

$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$article1 = new Article();
$article1->setTitle('aaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new Article();
$article2->setTitle('bbb');
$article2->save();

$article = sfPropelFinder::from('Article')->
  leftJoin('Category')->
  with('Category')->
  findLast();
$t->isa_ok($article->getCategory(), 'NULL', 'In a left join using with(), empty related objects are not hydrated');

$t->diag('sfPropelFinder::addJoin() not being redirected to Criteria');
try
{
  $article = sfPropelFinder::from('Article')->
    addJoin(ArticlePeer::CATEGORY_ID, CategoryPeer::ID, Criteria::LEFT_JOIN)->
    findLast();
  $t->pass('addJoin() is properly redirected to the Criteria object');
}
catch(Exception $e)
{
  $t->fail('addJoin() is properly redirected to the Criteria object');
}

$t->diag('sfPropelFinder::join() called several times');

try
{
  sfPropelFinder::from('Article')->
    join('Category')->
    join('Category')->
    count();
  $t->pass('join() can be called several times on the same class');
}
catch(Exception $e)
{
  $t->fail('join() can be called several times on the same class');
}

$t->diag('sfPropelFinder::withColumn() on calculated columns with decimals');
$finder = sfPropelFinder::from('Article');
try
{
  $finder->withColumn('COUNT(Comment.Id) * 1.5', 'foo')->findOne();
  $t->pass('withColumn() doesn\'t transform decimal numbers');
}
catch(Exception $e)
{
  $t->fail('withColumn() doesn\'t transform decimal numbers');
}

$t->diag('sfPropelFinder::with() does not fail with two left joins and missing related objects');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
Articlei18nPeer::doDeleteAll();
AuthorPeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('aaa');
$article1->save();
$comment1 = new Comment();
$comment1->setArticleId($article1->getId());
$comment1->save();
$author1 = new Author();
$author1->setName('auth1');
$author1->save();
$comment2 = new Comment();
$comment2->setArticleId($article1->getId());
$comment2->setAuthor($author1);
$comment2->save();

$finder = sfPropelFinder::from('Comment')->
  leftJoin('Author')->with('Author')->
  leftJoin('Article')->with('Article');
$comments = $finder->find();
$latestQuery = $finder->getLatestQuery();
$t->is($comments[0]->getAuthor(), null, 'First object has no author');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $latestQuery, 'Related hydration occurred correctly');
$t->isnt($comments[0]->getArticle(), null, 'First object has an article');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $latestQuery, 'Related hydration occurred correctly');
$t->isnt($comments[1]->getAuthor(), null, 'Second object has an author');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $latestQuery, 'Related hydration occurred correctly');
$t->isnt($comments[1]->getArticle(), null, 'Second object has an article');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $latestQuery, 'Related hydration occurred correctly');

$t->diag('sfPropelFinder::with() and exotic phpNames');

CivilityPeer::doDeleteAll();
HumanPeer::doDeleteAll();
$civility1 = new Civility();
$civility1->setIsMan(true);
$civility1->save();
$person1 = new Person();
$person1->setName('John');
$person1->setCivility($civility1);
$person1->save();

$finder = sfPropelFinder::from('Person')->
  with('Civility');
$person = $finder->findOne();
$latestQuery = $finder->getLatestQuery();
$t->is($person->getCivility()->getIsMan(), true, 'Related Objects with a non-natural phpName get hydrated correctly');
$t->is(Propel::getConnection()->getLastExecutedQuery(), $latestQuery, 'Related hydration occurred correctly');
