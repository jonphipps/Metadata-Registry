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
CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();

$t = new lime_test(148, new lime_output_color());

$t->diag('find()');

$finder = new sfPropelFinder('Article');
$articles = $finder->find();
$t->is($articles, array(), 'find() returns an empty array when no records match');

$article1 = new Article();
$article1->setTitle('foo');
$article1->save();

$finder = new sfPropelFinder('Article');
$articles = $finder->find();
$article = $articles[0];
$t->is($article->getTitle(), 'foo', 'find() returns an array of record');
$t->is(get_class($article), 'Article', 'find() returns an array of objects of the requested class');

$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$article3 = new Article();
$article3->setTitle('foo3');
$article3->save();

$finder = new sfPropelFinder('Article');
$articles = $finder->find();
$t->is(count($articles), 3, 'find() with no argument returns an array of all the records');
$article = array_shift($articles);
$t->is($article->getTitle(), 'foo', 'find() with no argument returns an array of all the records');
$article = array_shift($articles);
$t->is($article->getTitle(), 'foo2', 'find() with no argument returns an array of all the records');
$article = array_shift($articles);
$t->is($article->getTitle(), 'foo3', 'find() with no argument returns an array of all the records');

$finder = new sfPropelFinder('Article');
$articles = $finder->find(2);
$t->is(count($articles), 2, 'find() with an argument returns a limited array of records');

$t->diag('findOne()');

ArticlePeer::doDeleteAll();

$finder = new sfPropelFinder('Article');
$article = $finder->findOne();
$t->is($article, null, 'findOne() returns null when no records match');

$article1 = new Article();
$article1->setTitle('foo');
$article1->save();

$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$finder = new sfPropelFinder('Article');
$article = $finder->findOne();
$t->isa_ok($article, 'Article', 'findOne() returns a single object');
$t->is($article->getTitle(), 'foo', 'findOne() returns the first object matching the conditions');

$t->diag('findLast() and findFirst()');

ArticlePeer::doDeleteAll();

$finder = new sfPropelFinder('Article');
$article = $finder->findFirst();
$t->is($article, null, 'findFirst() returns null when no records match');

$finder = new sfPropelFinder('Article');
$article = $finder->findLast();
$t->is($article, null, 'findLast() returns null when no records match');

$article1 = new Article();
$article1->setTitle('foo');
$article1->save();

$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$finder = new sfPropelFinder('Article');
$article = $finder->findFirst();
$t->isa_ok($article, 'Article', 'findFirst() returns a single object');
$t->is($article->getTitle(), 'foo', 'findFirst() returns the last object matching the conditions');

$finder = new sfPropelFinder('Article');
$article = $finder->findLast();
$t->isa_ok($article, 'Article', 'findLast() returns a single object');
$t->is($article->getTitle(), 'foo2', 'findLast() returns the last object matching the conditions');

$t->diag('findBy() and findOneBy()');

ArticlePeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('foo');
$article1->save();

$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$article3 = new Article();
$article3->setTitle('foo');
$article3->save();

$articles = sfPropelFinder::from('Article')->findBy('Title', 'foo');
$t->is(count($articles), 2, 'findBy() adds a condition on a given column');
foreach ($articles as $article)
{
  $t->is($article->getTitle(), 'foo', 'findBy() adds a condition on a given column');
}

$articles = sfPropelFinder::from('Article')->findBy('Title', 'foo', 1);
$t->is(count($articles), 1, 'findBy() accepts a limit parameter');

$article = sfPropelFinder::from('Article')->findOneBy('Title', 'foo2');
$t->is($article->getTitle(), 'foo2', 'findOneBy() adds a condition on a given column');

$articles = sfPropelFinder::from('Article')->findByTitle('foo');
$t->is(count($articles), 2, 'findByXXX() adds a condition on a given column');
foreach ($articles as $article)
{
  $t->is($article->getTitle(), 'foo', 'findByXXX() adds a condition on a given column');
}

$articles = sfPropelFinder::from('Article')->findByTitle('foo', 1);
$t->is(count($articles), 1, 'findByXXX() accepts a limit parameter');

$article = sfPropelFinder::from('Article')->findOneByTitle('foo2');
$t->is($article->getTitle(), 'foo2', 'findOneByXXX() adds a condition on a given column');

$t->diag('findPk()');

ArticlePeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('foo');
$article1->save();

$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$article3 = new Article();
$article3->setTitle('foo3');
$article3->save();

$finder = new sfPropelFinder('Article');
$article = $finder->findPk($article2->getId());
$t->is($article->getTitle(), 'foo2', 'findPk() returns the object with the primary key matching the argument');
$t->ok(!is_array($article), 'findPk() returns a single object when passed a single primary key');
$finder = new sfPropelFinder('Article');
$article = $finder->findPk(76543787654);
$t->is($article, null, 'findPk() returns null if the primary key is not found');
$finder = new sfPropelFinder('Article');
$articles = $finder->findPk(array($article2->getId(), $article1->getId()));
$t->ok(is_array($articles), 'findPk() returns an array of objects when passed an array of primary keys');
$t->is(count($articles), 2, 'findPk() returns the objects with the primary keys matching the arguments');

$article = $finder->with('Category')->findPk($article2->getId());
$t->cmp_ok(strpos($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, category.ID, category.NAME FROM article INNER JOIN category'), '===', 0, 'findPk() is compatible with with()');

ArticlePeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('foo');
$article1->setCulture('fr');
$article1->setContent('Bar');
$article1->save();
$articlei18n1 = $article1->getCurrentArticleI18n();
try
{
  $articleI18n = sfPropelFinder::from('ArticleI18n')->findPk($articlei18n1->getId());
  $t->fail('findPk() expects an array of values for objects with composite primary keys');
}
catch(Exception $e)
{
  $t->pass('findPk() expects an array of values for objects with composite primary keys');
}
$articleI18n = sfPropelFinder::from('ArticleI18n')->findPk(array($articlei18n1->getId(), $articlei18n1->getCulture()));
$t->ok($articleI18n->equals($articlei18n1), 'findPk() retrieves objects with composite primary keys based on an array of Pks');

$t->diag('Instanciation possibilities');

ArticlePeer::doDeleteAll();

$article1 = new Article();
$article1->setTitle('foo');
$article1->save();

$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();

$article3 = new Article();
$article3->setTitle('foo3');
$article3->save();

$finder = new sfPropelFinder('Article');
$t->is($finder->getClass(), 'Article', 'Class can be set during instanciation, in which case the finder is automatically initialized');
$article = $finder->findOne();
$t->isa_ok($article, 'Article', 'A finder instanciated directly with a class returns the correct objects');
$t->is($article->getTitle(), 'foo', 'A finder instanciated directly with a class returns the correct objects');

$finder = new sfPropelFinder();
$finder->setClass('Article');
$t->is($finder->getClass(), 'Article', 'setClass() and getClass() are accesors to the protected $class property');
$article = $finder->findOne();
$t->isa_ok($article, 'Article', 'A finder instanciated directly with a class returns the correct objects');
$t->is($article->getTitle(), 'foo', 'A finder can be instanciated without parameter, and initialized later after defining its peer class');

$articles = sfPropelFinder::from('Article')->find();
$t->is(count($articles), 3, 'from() allows direct chaining of conditions');

class ArticleFinder extends sfPropelFinder
{
  protected $class = 'Article';
}
$finder = new ArticleFinder();
$article = $finder->findOne();
$t->isa_ok($article, 'Article', 'A finder extending sfPropelFinder can be used directly if defining the $class property');
$finder = new ArticleFinder();
$articles = $finder->find();
$t->is(count($articles), 3, 'A finder extending sfPropelFinder can be used directly if defining the $class property');

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

$finder = sfPropelFinder::from($category1->getArticles());
$articles = $finder->find();
$t->is(count($articles), 2, 'from() accepts an array of Propel objects');
$t->isnt(
  strpos($finder->getLatestQuery(), "WHERE article.ID IN ("),
  false,
  'using from() with an array of Propel objects results in a Criteria::IN'
);
$t->isa_ok($finder->findOne(), 'Article', 'using from() with an array of Propel objects returns some of these objects');
$articles = sfPropelFinder::from($category1->getArticles())->where('Title', 'aaaaa')->find();
$t->is(count($articles), 1, 'A finder initialized from an array accepts further conditions');

$t->diag('count()');

ArticlePeer::doDeleteAll();
$finder = new sfPropelFinder('Article');
$nbArticles = $finder->count();
$t->isa_ok($nbArticles, 'integer', 'count() returns an integer');
$t->is($nbArticles, 0, 'count() returns 0 on empty tables');
$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();
$article3 = new Article();
$article3->setTitle('foo3');
$article3->save();
$nbArticles = $finder->count();
$t->is($nbArticles, 2, 'count() returns the number of records matching the condition');
$nbArticles = $finder->whereTitle('foo2')->count();
$t->is($nbArticles, 1, 'count() returns the number of records matching the condition');

$t->diag('delete()');

ArticlePeer::doDeleteAll();
$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();
$article3 = new Article();
$article3->setTitle('foo3');
$article3->save();
$finder = new sfPropelFinder('Article');
$nbArticles = $finder->count();
$t->is($nbArticles, 2, 'delete() deletes records from the table and returns the number of deleted rows');
$nbDeleted = $finder->delete();
$t->is($nbDeleted, 2, 'delete() deletes records from the table and returns the number of deleted rows');
$nbArticles = $finder->count();
$t->is($nbArticles, 0, 'delete() on an empty finder deletes all rows');
$article2 = new Article();
$article2->setTitle('foo2');
$article2->save();
$article3 = new Article();
$article3->setTitle('foo3');
$article3->save();
$finder = new sfPropelFinder('Article');
$nbDeleted = $finder->where('Title', 'foo2')->delete();
$t->is($nbDeleted, 1, 'delete() deletes all rows found by a finder');
$nbArticles = $finder->count();
$t->is($nbArticles, 1, 'delete() does not delete rows not found by the finder');

$t->diag('where()');

ArticlePeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('abc');
$article1->save();
$article2 = new Article();
$article2->setTitle('def');
$article2->save();
$article3 = new Article();
$article3->setTitle('bbc');
$article3->save();
$article = sfPropelFinder::from('Article')->where('Title', 'abc')->findOne();
$t->is($article->getId(), $article1->getId(), 'where() accepts a simple CamelCase column name like ClassName');
try
{
  $article = sfPropelFinder::from('Article')->where('Foo', 'abc');
  $t->fail('where() throws an exception when the column is not found');
}
catch (Exception $e)
{
  $t->pass('where() throws an exception when the column is not found');
}
$article = sfPropelFinder::from('Article')->where('Article.Title', 'abc')->findOne();
$t->is($article->getId(), $article1->getId(), 'where() accepts a complete column name ClassName.ColumnName');
$article = sfPropelFinder::from('Article')->where('Article_Title', 'abc')->findOne();
$t->is($article->getId(), $article1->getId(), 'where() accepts a complete column name ClassName_ColumnName');
$article = sfPropelFinder::from('Article')->where('Title', 'def')->findOne();
$t->is($article->getId(), $article2->getId(), 'where() adds a WHERE condition on the column given as first argument');
$articles = sfPropelFinder::from('Article')->where('Title', Criteria::LIKE, '%bc')->find();
$t->is(count($articles), 2, 'where() accepts a comparator as second argument when three arguments are given');
$articles = sfPropelFinder::from('Article')->where('Title', 'like', '%bc')->find();
$t->is(count($articles), 2, 'where() accepts a text comparator and is permissive on syntax');
$articles = sfPropelFinder::from('Article')->where('Title', 'is not null', null)->find();
$t->is(count($articles), 3, 'where() accepts a text comparator and is permissive on syntax');
$articles = sfPropelFinder::from('Article')->where('Title', 'is not null')->find();
$t->is(count($articles), 3, 'where() accepts "is not null" as a value and transforms it into an operator');
$articles = sfPropelFinder::from('Article')->where('Title', 'is null')->find();
$t->is(count($articles), 0, 'where() accepts "is null" as a value and transforms it into an operator');
$articles = sfPropelFinder::from('Article')->where('Title', 'in', array('abc', 'def'))->find();
$t->is(count($articles), 2, 'where() accepts a "in" comparator');
$articles = sfPropelFinder::from('Article')->where('Title', 'not in', array('abc', 'def'))->find();
$t->is(count($articles), 1, 'where() accepts a "not in" comparator');
try
{
  $article = sfPropelFinder::from('Article')->whereFoo('abc');
  $t->fail('whereXXX() throws an exception when the XXX column is not found');
}
catch (Exception $e)
{
  $t->pass('whereXXX() throws an exception when the XXX column is not found');
}

try
{
  $article = sfPropelFinder::from('Article')->wherecategoryid('abc');
  $t->fail('whereXXX() expects a column name in CamelCase');
}
catch (Exception $e)
{
  $t->pass('whereXXX() expects a column name in CamelCase');
}

try
{
  $article = sfPropelFinder::from('Article')->whereCategoryId('abc');
  $t->pass('whereXXX() expects a column name in CamelCase');
}
catch (Exception $e)
{
  $t->fail('whereXXX() expects a column name in CamelCase');
}

try
{
  $article = sfPropelFinder::from('Article')->whereTitle('abc', 'def', 'ghi', 'jkl');
  $t->fail('whereXXX() throws an exception when called with more than three parameters');
}
catch (Exception $e)
{
  $t->pass('whereXXX() throws an exception when called with more than three parameters');
}

$article = sfPropelFinder::from('Article')->whereTitle('abc')->findOne();
$t->is($article->getId(), $article1->getId(), 'whereXXX() adds a where condition according to the XXX column name');
$article = sfPropelFinder::from('Article')->whereArticle_Title('abc')->findOne();
$t->is($article->getId(), $article1->getId(), 'whereXXX() accepts a complete column name like whereClassName_ColumnName()');
$article = sfPropelFinder::from('Article')->whereTitle('def')->findOne();
$t->is($article->getId(), $article2->getId(), 'whereXXX() adds a WHERE condition on the XXX column');
$articles = sfPropelFinder::from('Article')->whereTitle(Criteria::LIKE, '%bc')->find();
$t->is(count($articles), 2, 'whereXXX() accepts a comparator as first argument when two arguments are given');

$t->diag('orWhere()');

$columns    = "article.ID, article.TITLE, article.CATEGORY_ID";
$baseSelect = "SELECT $columns FROM article WHERE ";

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  orWhere('Title', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' OR article.TITLE='bar')",
  'orWhere() adds a SQL OR clause when called on a column where there is already a condition'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  orWhere('CategoryId', 1);
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' OR article.CATEGORY_ID=1)",
  'orWhere() adds a SQL OR clause when called on a column where there is no condition yet'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  where('Title', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' AND article.TITLE='bar')",
  'where() adds a SQL AND clause when called on a column where there is already a condition'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  where('CategoryId', 1);
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' AND article.CATEGORY_ID=1)",
  'where() adds a SQL AND clause when called on a column where there is no condition yet'
);

$finder = sfPropelFinder::from('Article')->
  where('CategoryId', 1)->
  where('Title', 'foo')->
  orWhere('Title', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.CATEGORY_ID=1 AND (article.TITLE='foo' OR article.TITLE='bar'))",
  'where() and orWhere() can be combined on the same finder'
);

$finder = sfPropelFinder::from('Article')->
  joinCategory()->
  where('Category.Name', 'foo')->
  orWhere('Category.Name', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  "SELECT $columns FROM article INNER JOIN category ON (article.CATEGORY_ID=category.ID) WHERE (category.NAME='foo' OR category.NAME='bar')",
  'orWhere() works on a simple jointure'
);

$finder = sfPropelFinder::from('Comment')->
  joinArticle()->
  joinAuthor()->
  where('Article.Title', 'foo')->
  orWhere('Author.Name', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  "SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID FROM comment INNER JOIN article ON (comment.ARTICLE_ID=article.ID) INNER JOIN author ON (comment.AUTHOR_ID=author.ID) WHERE (article.TITLE='foo' OR author.NAME='bar')",
  'orWhere() works on a multiple jointure'
);

$t->diag('whereCustom');

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = ?', 'foo');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = 'foo'",
  'whereCustom() adds a custom SQL AND clause and replaces the ? token by the value passed as second argument'
);

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = %s', 'foo');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = 'foo'",
  'whereCustom() adds a custom SQL AND clause and replaces the %s token by the value passed as second argument'
);

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = ? + ?', array('foo', 'bar'));
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = 'foo' + 'bar'",
  'whereCustom() adds a custom SQL AND clause and replaces the ? tokens by the values passed as an array in second argument'
);

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = %dude% + %dudy%', array('%dude%' => 'foo', '%dudy%' => 'bar'));
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = 'foo' + 'bar'",
  'whereCustom() adds a custom SQL AND clause and replaces the ? tokens by the values passed as an associative array in second argument'
);

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = ?', "foo'");
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = 'foo'''",
  'whereCustom() properly escapes values'
);

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = ?', 1);
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = '1'",
  'whereCustom() considers all values as strings'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  whereCustom('upper(Article.Title) = ?', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' AND upper(article.TITLE) = 'bar')",
  'whereCustom() adds an SQL AND clause'
);

$t->diag('orWhereCustom');

$finder = sfPropelFinder::from('Article')->
  orWhereCustom('upper(Article.Title) = ?', 'foo');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "upper(article.TITLE) = 'foo'",
  'orWhereCustom() acts like whereCustom() when there is only one condition'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', 'foo')->
  orWhereCustom('upper(Article.Title) = ?', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' OR upper(article.TITLE) = 'bar')",
  'whereCustom() adds an SQL OR clause'
);

$t->diag('combine()');

$columns    = "article.ID, article.TITLE, article.CATEGORY_ID";
$baseSelect = "SELECT $columns FROM article WHERE ";

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "article.TITLE='bar'",
  'where() called with a named condition does not affect the SQL until it is combined'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  combine(array('cond1', 'cond2'), 'or');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' OR article.TITLE='bar')",
  'combine() combines conditions into the main criteria'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  combine(array('cond1', 'cond2'), 'and');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foo' AND article.TITLE='bar')",
  'combine() combines conditions into the main criteria'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', 'is null', null, 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  combine(array('cond1', 'cond2'), 'or');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE IS NULL  OR article.TITLE='bar')",
  'combine() accepts named conditions with null value'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  where('Title', '=', 'foobar')->
  combine(array('cond1', 'cond2'), 'or');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(article.TITLE='foobar' AND (article.TITLE='foo' OR article.TITLE='bar'))",
  'combine() clauses live well with the usual conditions'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  combine(array('cond1', 'cond2'), 'or')->
  where('Title', '=', 'foobar');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "((article.TITLE='foo' OR article.TITLE='bar') AND article.TITLE='foobar')",
  'combine() clauses live well with the usual conditions and appear ordered as they were called'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  where('Title', '=', 'foobar', 'cond3')->
  combine(array('cond1', 'cond2'), 'or', 'cond4')->
  combine(array('cond4', 'cond3'), 'and');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "((article.TITLE='foo' OR article.TITLE='bar') AND article.TITLE='foobar')",
  'combine() can return a named condition'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  where('Title', '=', 'foobar', 'cond3')->
  where('Title', '=', 'boofar', 'cond4')->
  combine(array('cond1', 'cond2'), 'or', 'cond6')->
  combine(array('cond3', 'cond4'), 'or', 'cond7')->
  combine(array('cond6', 'cond7'), 'and');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "((article.TITLE='foo' OR article.TITLE='bar') AND (article.TITLE='foobar' OR article.TITLE='boofar'))",
  'combine() allows for imbricated conditions'
);

$finder = sfPropelFinder::from('Article')->
  where('Title', '=', 'foo', 'cond1')->
  where('Title', '=', 'bar', 'cond2')->
  where('Title', '=', 'foobar', 'cond3')->
  combine(array('cond1', 'cond2', 'cond3'), 'or');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "((article.TITLE='foo' OR article.TITLE='bar') OR article.TITLE='foobar')",
  'combine() can combine more than two conditions'
);

$finder = sfPropelFinder::from('Article')->
  whereCustom('upper(Article.Title) = ?', 'foo', 'cond1')->
  whereCustom('upper(Article.Title) = ?', 'bar', 'cond2')->
  combine(array('cond1', 'cond2'), 'or');
$finder->find();
$t->is(
  $finder->getLatestQuery(),
  $baseSelect . "(upper(article.TITLE) = 'foo' OR upper(article.TITLE) = 'bar')",
  'combine() combines conditions added by way of whereCustom()'
);

$t->diag('limit() and offset()');

ArticlePeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('abc');
$article1->save();
$article2 = new Article();
$article2->setTitle('def');
$article2->save();
$article3 = new Article();
$article3->setTitle('bbc');
$article3->save();

$articles = sfPropelFinder::from('Article')->limit(1)->find();
$t->is(count($articles), 1, 'limit() adds a limit to the SQL clause');
$article = $articles[0];
$t->is($article->getTitle(), 'abc', 'limit() adds a limit to the SQL clause');
$articles = sfPropelFinder::from('Article')->limit(2)->find();
$t->is(count($articles), 2, 'limit() adds a limit to the SQL clause');
$article = $articles[0];
$t->is($article->getTitle(), 'abc', 'limit() adds a limit to the SQL clause');
$article = $articles[1];
$t->is($article->getTitle(), 'def', 'limit() adds a limit to the SQL clause');

$articles = sfPropelFinder::from('Article')->offset(1)->find();
$t->is(count($articles), 2, 'offset() adds an offset to the SQL clause');
$article = $articles[0];
$t->is($article->getTitle(), 'def', 'offset() adds an offset to the SQL clause');
$article = $articles[1];
$t->is($article->getTitle(), 'bbc', 'offset() adds an offset to the SQL clause');

$articles = sfPropelFinder::from('Article')->offset(1)->limit(1)->find();
$t->is(count($articles), 1, 'limit() and offset() can be combined');
$article = $articles[0];
$t->is($article->getTitle(), 'def', 'limit() and offset() can be combined');

$t->diag('keepQuery()');

ArticlePeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->save();
$article2 = new Article();
$article2->setTitle('bbbbb');
$article2->save();
$finder = sfPropelFinder::from('Article');
$nbArticles1 = $finder->where('Title', 'aaaaa')->count();
$nbArticles2 = $finder->count();
$t->isnt($nbArticles1, $nbArticles2, 'By default, the query is reinitialized after a termination method');
$finder = sfPropelFinder::from('Article')->keepQuery();
$nbArticles1 = $finder->where('Title', 'aaaaa')->count();
$nbArticles2 = $finder->count();
$t->is($nbArticles1, $nbArticles2, 'Using keepQuery() keeps the query between two termination methods');

$t->diag('relatedTo()');

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

$articles = sfPropelFinder::from('Article')->relatedTo($category1)->find();
$t->is(count($articles), 2, 'relatedTo() filters results to the ones relative to a record in a 1-n relationship');
foreach($articles as $article)
{
  $t->is($article->getCategoryId(), $category1->getId(), 'relatedTo() filters results to the ones relative to a record in a 1-n relationship');
}
$article = sfPropelFinder::from('Article')->relatedTo($category2)->findOne();
$t->is($article->getCategoryId(), $category2->getId(), 'relatedTo() filters results to the ones relative to a record in a 1-n relationship');
$category = sfPropelFinder::from('Category')->relatedTo($article1)->findOne();
$t->is($category->getId(), $category1->getId(), 'relatedTo() filters results to the ones relative to a record in a n-1 relationship');
$category = sfPropelFinder::from('Category')->relatedTo($article3)->findOne();
$t->is($category->getId(), $category2->getId(), 'relatedTo() filters results to the ones relative to a record in a n-1 relationship');

$t->diag('orderBy()');

ArticlePeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('bbbbb');
$article1->save();
$article2 = new Article();
$article2->setTitle('aaaaa');
$article2->save();
$article3 = new Article();
$article3->setTitle('ccccc');
$article3->save();

$article = sfPropelFinder::from('Article')->orderBy('Title')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'orderBy() orders by column asc by default');

$article = sfPropelFinder::from('Article')->orderBy('Title', 'asc')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'orderBy() orders by column and takes an order as second argument');

$article = sfPropelFinder::from('Article')->orderBy('Title', 'desc')->findOne();
$t->is($article->getTitle(), 'ccccc', 'orderBy() orders by column and takes an order as second argument');

try
{
  $article = sfPropelFinder::from('Article')->orderBy('Title', 'abc');
  $t->fail('orderBy() throws an exception when called with a second argument different from "asc" or "desc"');
}
catch (Exception $e)
{
  $t->pass('orderBy() throws an exception when called with a second argument different from "asc" or "desc"');
}

try
{
  $article = sfPropelFinder::from('Article')->orderByFoo();
  $t->fail('orderByXXX() throws an exception when the XXX column is not found');
}
catch (Exception $e)
{
  $t->pass('orderByXXX() throws an exception when the XXX column is not found');
}

try
{
  $article = sfPropelFinder::from('Article')->orderByTitle();
  $t->pass('orderByXXX() expects a column name in CamelCase');
}
catch (Exception $e)
{
  $t->fail('orderByXXX() expects a column name in CamelCase');
}

$article = sfPropelFinder::from('Article')->orderByTitle()->findOne();
$t->is($article->getTitle(), 'aaaaa', 'orderByXXX() orders by column according to the XXX column name');

$article = sfPropelFinder::from('Article')->orderByTitle('asc')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'orderByXXX() takes an order as argument');

$article = sfPropelFinder::from('Article')->orderByTitle('desc')->findOne();
$t->is($article->getTitle(), 'ccccc', 'orderByXXX() takes an order as argument');

$t->diag('groupBy()');

CommentPeer::doDeleteAll();
AuthorPeer::doDeleteAll();
ArticlePeer::doDeleteAll();

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

$finder = sfPropelFinder::from('Article')->
  join('Comment')->
  groupBy('Article.Id')->
  withColumn('COUNT(Comment.Id)', 'NbComments');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, COUNT(comment.ID) AS NbComments FROM article INNER JOIN comment ON (article.ID=comment.ARTICLE_ID) GROUP BY article.ID LIMIT 1', 'groupBy() accepts a column name and issues a GROUP BY clause');

$finder = sfPropelFinder::from('Comment')->
  join('Article')->
  withColumn('Article.Id', 'aid')->
  groupBy('aid');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID, article.ID AS aid FROM comment INNER JOIN article ON (comment.ARTICLE_ID=article.ID) GROUP BY aid LIMIT 1', 'groupBy() accepts a column alias and issues a GROUP BY clause');

$finder = sfPropelFinder::from('Comment')->
  join('Article')->
  groupByArticle_Id();
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT comment.ID, comment.CONTENT, comment.ARTICLE_ID, comment.AUTHOR_ID FROM comment INNER JOIN article ON (comment.ARTICLE_ID=article.ID) GROUP BY article.ID LIMIT 1', 'groupByXXX() accepts a column name and issues a GROUP BY clause');

$t->diag('groupByClass()');

CommentPeer::doDeleteAll();
AuthorPeer::doDeleteAll();
ArticlePeer::doDeleteAll();

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

$finder = sfPropelFinder::from('Article')->
  join('Comment')->
  groupByClass('Article')->
  withColumn('COUNT(Comment.Id)', 'NbComments');
$article = $finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID, COUNT(comment.ID) AS NbComments FROM article INNER JOIN comment ON (article.ID=comment.ARTICLE_ID) GROUP BY article.ID,article.TITLE,article.CATEGORY_ID LIMIT 1', 'groupByClass() accepts a model class name and issues a GROUP BY clause on all columns');

$t->diag('set()');

CommentPeer::doDeleteAll();
AuthorPeer::doDeleteAll();
ArticlePeer::doDeleteAll();

$article1 = new Article;
$article1->setTitle('foo');
$article1->save();
$article2 = new Article;
$article2->setTitle('bar');
$article2->save();

$finder = sfPropelFinder::from('Article');
$t->is($finder->set(array('Title' => 'updated title')), 2, 'set() returns the number of updated rows');
$t->is($finder->getLatestQuery(), propel_sql('UPDATE article SET TITLE[P12 ]=[P12 ]\'updated title\' WHERE 1=1'), 'set() issues an update query even when passed an empty finder');
$t->is(sfPropelFinder::from('Article')->where('Title', 'updated title')->count(), 2, 'set() updates all records when passed an empty finder');

ArticlePeer::doDeleteAll();

$article1 = new Article;
$article1->setTitle('foo');
$article1->save();
$article2 = new Article;
$article2->setTitle('bar');
$article2->save();

$finder = sfPropelFinder::from('Article')->where('Title', 'foo');
$t->is($finder->set(array('Title' => 'updated title')), 1, 'set() returns the number of updated rows');
$t->is($finder->getLatestQuery(), propel_sql('UPDATE article SET TITLE[P12 ]=[P12 ]\'updated title\' WHERE article.TITLE=\'foo\''), 'set() issues an Update query when passed a finder');
$t->is(sfPropelFinder::from('Article')->where('Title', 'updated title')->count(), 1, 'set() updates only the records found based on the array of values');

$finder = sfPropelFinder::from('Article')->where('Title', 'bar');
$t->is($finder->set(array('Title' => 'updated title'), true), 1, 'set() returns the number of updated rows, even with $forceIndividualSaves set to true');
$t->isnt($finder->getLatestQuery(), 'UPDATE article SET TITLE = \'updated title\' WHERE article.TITLE=\'bar\'', 'set() issues an Update query on every record when passed a finder with $forceIndividualSaves set to true');
$t->is(sfPropelFinder::from('Article')->where('Title', 'updated title')->count(), 2, 'set() updates only the records found based on the array of values, even with $forceIndividualSaves set to true');

try
{
  sfPropelFinder::from('Comment')->joinArticle()->where('Article_Title', 'updated title')->set(array('Title' => 3));
  $t->fail('set() throws an exception when called on a finder with join()');
}
catch( Exception $e )
{
  $t->pass('set() throws an exception when called on a finder with join()');
}

$t->diag('Table alias');

ArticlePeer::doDeleteAll();
$article1 = new Article();
$article1->setTitle('abc');
$article1->save();
$article = sfPropelFinder::from('Article a')->where('a.Title', 'abc')->findOne();
$t->is($article->getId(), $article1->getId(), 'from() accepts a table alias');

$t->diag('Debugging functions');

$finder = sfPropelFinder::from('Article')->where('Title', 'foo');
$t->isa_ok($finder->getQueryObject(), 'Criteria', 'getQueryObject() returns the criteria as composed by the finder');
$finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article WHERE article.TITLE=\'foo\' LIMIT 1', 'getLatestQuery() returns the latest SQL query');
$finder = sfPropelFinder::from('Article')->add(ArticlePeer::TITLE, 'bar');
$finder->findOne();
$t->is($finder->getLatestQuery(), 'SELECT article.ID, article.TITLE, article.CATEGORY_ID FROM article WHERE article.TITLE=\'bar\' LIMIT 1', 'you can call Criteria methods directly on the finder object to modify its Criteria');