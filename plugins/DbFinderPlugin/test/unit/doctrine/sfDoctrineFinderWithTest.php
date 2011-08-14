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

    connection:    doctrine

    DArticle:
      columns:
        title:       string(255)
        category_id: integer
        content:     string(255)
      relations:
        Category:
          class:    DCategory
          local:    category_id
          type:     one
          foreign:  id
          foreignAlias: Articles
      actAs:
        I18n:
          fields: [content]

    DArticleI18n:
      columns:
        id:          { type: integer, primary: true }
        culture:     { type: string(5), primary: true }
        content:     string(255)

    DCategory:
      columns:
        name:        string(255)

    DComment:
      columns:
        content:     string(255)
        article_id:  integer
        author_id:   integer
      relations:
        Author:
          class: DAuthor
          local: author_id
          foreign: id
          type: one
        Article:
          class: DArticle
          local: article_id
          foreign: id
          type: one

    DAuthor:
      columns:
        name:        string(255)

    DCivility:
      columns:
        is_man:      boolean

    DClub:
      columns:
        code:        string(100)

    DClubI18n:
      columns:
        motto:       string(255)

    DPerson:
      columns:
        id:          { type: integer, primary: true }
        name:        string(255)
        foo:         integer
        the_sex:     integer
      relations:
        Club:
          class: DClub
          local: foo
          foreign: id
          onDelete: cascade
          type: one
          foreignAlias: Persons
        Sex:
          class: DCivility
          local: the_sex
          foreign: id
          onDelete: cascade
          type: one
          foreignAlias: Persons

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(46, new lime_output_color());

$t->diag('with()');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
// Identity Map is there... No query will be issued to fetch an article Category, unless we clear the map
Doctrine::getTable('DCategory')->clear();
Doctrine::getTable('DArticle')->clear();
$finder = sfDoctrineFinder::from('DArticle');
$article = $finder->findOne();
$sql = $finder->getLatestQuery();
$article->getCategory()->getName();
$t->isnt($finder->getLatestQuery(), $sql, 'Calling a getter on a related object issues a new query');

Doctrine::getTable('DCategory')->clear();
Doctrine::getTable('DArticle')->clear();
$finder = sfDoctrineFinder::from('DArticle')->join('DCategory')->with('DCategory');
$article = $finder->findOne();
$sql = $finder->getLatestQuery();
$expectedSQL = 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id, d2.id AS d2__id, d2.name AS d2__name FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id LIMIT 1';
$t->is($sql, $expectedSQL, 'with() hydrates the related classes and avoids subsequent queries');
$article->getCategory()->getName();
$t->is($finder->getLatestQuery(), $sql, 'with() hydrates the related classes and avoids subsequent queries');

$t->is($article->getTitle(), 'aaaaa', 'fetching objects with a with() returns the correct main object');
$t->is($article->getCategory()->getName(), 'cat1', 'fetching objects with a with() returns the correct related object');

$finder = sfDoctrineFinder::from('DArticle')->with('DCategory');
$article = $finder->findOne();
$sql = $finder->getLatestQuery();
$t->is($sql, $expectedSQL, 'with() adds a join if not already added');
$article->getCategory()->getName();
$t->is($finder->getLatestQuery(), $sql, 'with() adds a join if not already added');

$finder = sfDoctrineFinder::from('DArticle')->with('Category');
$article = $finder->findOne();
$sql = $finder->getLatestQuery();
$t->is($sql, $expectedSQL, 'with() accepts a relation name instead of a class name');

$finder = sfDoctrineFinder::from('DArticle')->leftJoin('DCategory')->with('DCategory');
$article = $finder->findOne();
$sql = $finder->getLatestQuery();
$t->is($sql, 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id, d2.id AS d2__id, d2.name AS d2__name FROM d_article d LEFT JOIN d_category d2 ON d.category_id = d2.id LIMIT 1', 'calling a particular join() before with() changes the join clause');

Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();
$article1 = new DArticle();
$article1->setTitle('bbbbb');
$article1->setCategory($category1);
$article1->save();
$author1 = new DAuthor();
$author1->setName('John');
$author1->save();
$comment = new DComment();
$comment->setContent('foo');
$comment->setArticleId($article1->getId());
$comment->setAuthor($author1);
$comment->save();
Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DComment')->clear();
Doctrine::getTable('DAuthor')->clear();
$finder = sfDoctrineFinder::from('DComment')->with('DArticle')->with('DAuthor');
$comment = $finder->findOne();
$sql = 'SELECT d.id AS d__id, d.content AS d__content, d.article_id AS d__article_id, d.author_id AS d__author_id, d2.id AS d2__id, d2.title AS d2__title, d2.category_id AS d2__category_id, d3.id AS d3__id, d3.name AS d3__name FROM d_comment d INNER JOIN d_article d2 ON d.article_id = d2.id INNER JOIN d_author d3 ON d.author_id = d3.id LIMIT 1';
$t->is($finder->getLatestQuery(), $sql, 'you can call with() several times to hydrate more than one related object');
$t->is($comment->getContent(), 'foo', 'you can call with() several times to hydrate more than one related object');
$t->is($comment->getArticle()->getTitle(), 'bbbbb', 'you can call with() several times to hydrate more than one related object');
$t->is($comment->getAuthor()->getName(), 'John', 'you can call with() several times to hydrate more than one related object');
$t->is($finder->getLatestQuery(), $sql, 'with() called several tims hydrates the related classes and avoids subsequent queries');

$sql = 'SELECT d.id AS d__id, d.content AS d__content, d.article_id AS d__article_id, d.author_id AS d__author_id, d2.id AS d2__id, d2.title AS d2__title, d2.category_id AS d2__category_id, d3.id AS d3__id, d3.name AS d3__name FROM d_comment d INNER JOIN d_article d2 ON d.article_id = d2.id INNER JOIN d_category d3 ON d2.category_id = d3.id LIMIT 1';
$finder = sfDoctrineFinder::from('DComment')->with('DArticle')->with('DCategory');
$comment = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'with() can even hydrate related objects via a related object');

$finder = sfDoctrineFinder::from('DComment')->with('DArticle', 'DCategory');
$comment = $finder->findOne();
$t->is($finder->getLatestQuery(), $sql, 'with() accepts several arguments, so you don\'t need to call it several times');

$t->diag('withI18N()');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$article1 = new DArticle();
$article1->setTitle('aaa');
$article1->Translation['en']->content = 'english content';
$article1->Translation['fr']->content = 'contenu français';
$article1->save();

$baseSQL = 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d LEFT JOIN d_article_translation d2 ON d.id = d2.id ';
sfContext::getInstance()->getUser()->setCulture('en');
$finder = sfDoctrineFinder::from('DArticle')->withI18n();
$article = $finder->findOne();
$query = $finder->getLatestQuery();
$t->is($query, $baseSQL . 'WHERE d2.lang = \'en\' LIMIT 1', 'withI18n() hydrates the related I18n object with a culture taken from the user object');
$t->is($article->Translation['en']->content, 'english content', 'withI18n() considers the current user culture for hydration');
$t->is($finder->getLatestQuery(), $query, 'withI18n() hydrates the i18n object so that no further query is necessary');

sfContext::getInstance()->getUser()->setCulture('fr');
$finder = sfDoctrineFinder::from('DArticle')->withI18n();
$article = $finder->findOne();
$query = $finder->getLatestQuery();
$t->is($finder->getLatestQuery(), $baseSQL . 'WHERE d2.lang = \'fr\' LIMIT 1', 'withI18n() hydrates the related I18n object with a culture taken from the user object');
$article->Translation['fr']->content; // already hydrated: should not cause a new query
$t->is($finder->getLatestQuery(), $query, 'withI18n() considers the current user culture for hydration');

sfContext::getInstance()->getUser()->setCulture('fr');
$finder = sfDoctrineFinder::from('DArticle')->withI18n('en');
$article = $finder->findOne();
$query = $finder->getLatestQuery();
$article->Translation['en']->content; // already hydrated: should not cause a new query
$t->is($finder->getLatestQuery(), $query, 'english content', 'withI18n() accepts a culture parameter to override the user culture');

sfContext::getInstance()->getUser()->setCulture('en');
$finder = sfDoctrineFinder::from('DArticle')->with('I18n');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $baseSQL . 'WHERE d2.lang = \'en\' LIMIT 1', 'with(\'I18n\') is a synonym for withI18n()');
$finder = sfDoctrineFinder::from('DArticle')->with('i18n');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), $baseSQL . 'WHERE d2.lang = \'en\' LIMIT 1', 'with(\'i18n\') is a synonym for withI18n()');

$t->diag('withColumn()');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$article1 = new DArticle();
$article1->setTitle('bbbbb');
$article1->setCategory($category1);
$article1->save();
$author1 = new DAuthor();
$author1->setName('John');
$author1->save();
$comment = new DComment();
$comment->setContent('foo');
$comment->setArticleId($article1->getId());
$comment->setAuthor($author1);
$comment->save();

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle')->
  findOne();
try
{
  $comment->getColumn('DArticle.Title');
  $t->fail('getColumn() is not available as long as you don\'t add a column with withColumn()');
}
catch(Exception $e)
{
  $t->pass('getColumn() is not available as long as you don\'t add a column with withColumn()');
}

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();

$article1 = new DArticle();
$article1->setTitle('bbbbb');
$article1->setCategory($category1);
$article1->save();
$author1 = new DAuthor();
$author1->setName('John');
$author1->save();
$comment = new DComment();
$comment->setContent('foo');
$comment->setArticleId($article1->getId());
$comment->setAuthor($author1);
$comment->save();

Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DComment')->clear();

$finder = sfDoctrineFinder::from('DComment')->
  join('DArticle')->
  withColumn('DArticle.Title');
$comment = $finder->findOne();
$t->is($comment['Article']['DArticle.Title'], 'bbbbb', 'Additional columns added with withColumn() are stored in the object and can be retrieved as properties of the related object');
try
{
  $t->is($comment->getColumn('DArticle.Title'), 'bbbbb', 'Additional columns added with withColumn() are stored in the object and can be retrieved with getColumn()');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.content AS d__content, d.article_id AS d__article_id, d.author_id AS d__author_id, d2.title AS d2__0 FROM d_comment d INNER JOIN d_article d2 ON d.article_id = d2.id LIMIT 1', 'Columns added with withColumn() can contain a dot');

Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DComment')->clear();

$finder = sfDoctrineFinder::from('DComment')->
  withColumn('DArticle.Title');
$comment = $finder->findOne();
try
{
  $t->is($comment->getColumn('DArticle.Title'), 'bbbbb', 'If withColumn() is called on a related object column with no join on this class, the finder adds the join automatically');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.content AS d__content, d.article_id AS d__article_id, d.author_id AS d__author_id, d2.title AS d2__0 FROM d_comment d INNER JOIN d_article d2 ON d.article_id = d2.id LIMIT 1', 'If withColumn() is called on a related object column with no join on this class, the finder adds the column automatically');

Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DComment')->clear();

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle')->
  withColumn('DArticle.Title', 'ArticleTitle')->
  findOne();
try
{
  $t->is($comment->getColumn('ArticleTitle'), 'bbbbb', 'withColumn() second parameter serves as a column alias');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}

Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DComment')->clear();

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle a')->
  withColumn('a.Title')->
  findOne();
try
{
  $t->is($comment->getColumn('a.Title'), 'bbbbb', 'withColumn() accepts a class alias');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}

Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DComment')->clear();

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle a')->
  withColumn('a.Title', 'b')->
  findOne();
try
{
  $t->is($comment->getColumn('b'), 'bbbbb', 'withColumn() accepts a class alias and a column alias');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle c')->
  withColumn('c.Title', 'GURSIKSO')->
  findOne();
try
{
  $t->is($comment->getColumn('GURSIKSO'), 'bbbbb', 'withColumn() plays well with Identity map (and doesn\'t require to clear the table prior to finding objects in it)');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}

// Test when additional column is in a chain of relations

Doctrine::getTable('DArticle')->clear();
Doctrine::getTable('DCategory')->clear();
Doctrine::getTable('DComment')->clear();
$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle')->
  join('DCategory')->
  withColumn('DCategory.Name')->
  findOne();
try
{
  $t->is($comment->getColumn('DCategory.Name'), 'cat1', 'withColumn() works even if the table of the withColumn is not directly related');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle')->join('DAuthor')->
  withColumn('DArticle.Title')->
  withColumn('DAuthor.Name')->
  findOne();
try
{
  $t->is($comment->getColumn('DArticle.Title'), 'bbbbb', 'withColumn() can be called several times');
  $t->is($comment->getColumn('DAuthor.Name'), 'John', 'withColumn() can be called several times');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11', 2);
}

$comment = sfDoctrineFinder::from('DComment')->
  join('DArticle')->with('DAuthor')->
  withColumn('DArticle.Title')->
  findOne();
try
{
  $t->is($comment->getColumn('DArticle.Title'), 'bbbbb', 'Columns added with withColumn() live together well with related objects added with with()');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}
$t->is($comment->getAuthor()->getName(), 'John', 'Related objects added with with() live together well with columns added with withColumn()');

$finder = sfDoctrineFinder::from('DArticle')->
  join('DComment d1')->
  groupBy('DArticle.Id')->
  withColumn('COUNT(DComment.Id)', 'NbComments');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id, COUNT(d2.id) AS d2__0 FROM d_article d INNER JOIN d_comment d2 ON d.id = d2.article_id GROUP BY d.id LIMIT 1', 'withColumn() accepts complex SQL calculations as additional column');
try
{
  $t->is($article->getColumn('NbComments'), 1, 'Complex SQL calculations can be retrieved by way of getColumn()');
}
catch(Doctrine_Record_Exception $e)
{
  $t->skip('getColumn() is not available with Doctrine 0.11');
}
$finder = sfDoctrineFinder::from('DArticle')->
  join('DComment')->
  groupBy('DArticle.Id')->
  withColumn('COUNT(DComment.ID)', 'NbComments')->
  orderBy('NbComments');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id, COUNT(d2.id) AS d2__0 FROM d_article d INNER JOIN d_comment d2 ON d.id = d2.article_id GROUP BY d.id ORDER BY d2__0 ASC LIMIT 1', 'Columns added with withColumn() can be used for sorting');

$t->diag('sfDoctrineFinder::with() issues with object finders classes');
class ArticleFinder extends sfDoctrineFinder
{
  protected $class = 'DArticle';
}

$finder = new ArticleFinder;
try
{
  $finder->join('DCategory')->find();
  $t->pass('Relations lookup work also on finder children objects');
}
catch (Exception $e)
{
  $t->fail('Relations lookup work also on finder children objects');
}
try
{
  $finder->with('DCategory')->find();
  $t->pass('Relations lookup work also on finder children objects');
}
catch (Exception $e)
{
  $t->fail('Relations lookup work also on finder children objects');
}

$t->diag('sfDoctrineFinder::with() and left joins');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$article1 = new DArticle();
$article1->setTitle('aaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbb');
$article2->save();

$article = sfDoctrineFinder::from('DArticle')->leftJoin('DCategory')->with('DCategory')->findLast();
$category = $article->getCategory();
if (is_object($category))
{
  $t->isa_ok($article->getCategory(), 'Doctrine_Null', 'In a left join using with(), empty related objects are not hydrated');
}
else
{
  $t->isa_ok($article->getCategory(), 'NULL', 'In a left join using with(), empty related objects are not hydrated');
}

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$t->diag('sfDoctrineFinder::withColumn() on calculated columns with decimals');
$finder = sfDoctrineFinder::from('DArticle');
try
{
  $finder->withColumn('COUNT(DComment.Id) * 1.5', 'foo')->findOne();
  $t->pass('withColumn() doesn\'t transform decimal numbers');
}
catch(Exception $e)
{
  $t->fail('withColumn() doesn\'t transform decimal numbers');
}