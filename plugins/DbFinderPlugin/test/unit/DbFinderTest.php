<?php
/*
 * This file is part of the DbFinder package.
 * 
 * (c) 2007 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
You need a model built with a running database to run these tests.
The tests expect a model similar to this one:

    # Doctrine model
    connection:    doctrine
    DArticle:
      columns:
        title:       string(255)
        category_id: integer

    # Propel model
    propel:
      article:
        id:          ~
        title:       varchar(255)
        category_id: ~

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../bootstrap.php';

$con = Propel::getConnection();

// cleanup databases
Doctrine_Query::create()->delete()->from('DArticle')->execute();
ArticlePeer::doDeleteAll();

$t = new lime_test(23, new lime_output_color());

$t->diag('from()');

$article1 = new DArticle();
$article1->setTitle('foo');
$article1->save();

$finder = DbFinder::from('DArticle');
$article = $finder->findOne();
$t->isa_ok($finder, 'DbFinder', 'from() called with a Doctrine class name returns a DbFinder');
$t->is($finder->getType(), DbFinderAdapterUtils::DOCTRINE, 'from() called with a Doctrine class name returns a DbFinder with a Doctrine adapter');
$t->ok($article instanceof Doctrine_Record, 'A DbFinder initialized from a Doctrine class returns Doctrine_Record objects');

$article2 = new Article();
$article2->setTitle('foo');
$article2->save();

$finder = DbFinder::from('Article');
$article = $finder->findOne();
$t->isa_ok($finder, 'DbFinder', 'from() called with a Propel class name returns a DbFinder');
$t->is($finder->getType(), DbFinderAdapterUtils::PROPEL, 'from() called with a Doctrine class name returns a DbFinder with a Propel adapter');
$t->ok($article instanceof BaseObject, 'A DbFinder initialized from a Propel class returns BaseObject objects');

$finderAsArray = DbFinder::from('Article')->toArray();
$article2Id = $article2->getId();
$t->is_deeply($finderAsArray, array(array('Id' => $article2Id, 'Title' => 'foo', 'CategoryId' => null)), 'toArray() executes the finder and returns an array with column phpNames as keys');

$finderAsString = (string) DbFinder::from('Article');
$expected = <<<FOO
Article_0:
  Id:        $article2Id
  Title:     foo
  CategoryId: 

FOO;
$t->is($finderAsString, $expected, '__toString() executes the finder and returns a string with column phpNames as keys');

$finderAsHtml = DbFinder::from('Article')->toHtml();
$expected = <<<FOO
<table class="DbFinder">
  <tr>
    <th>Id</th>
    <th>Title</th>
    <th>CategoryId</th>
  </tr>
  <tr>
    <td>$article2Id</td>
    <td>foo</td>
    <td></td>
  </tr>
</table>

FOO;
$t->is($finderAsHtml, $expected, 'toHTML() executes the finder and returns a string with an HTML table with column phpNames as column headers');

$t->diag('Custom finders');

class ArticleFinder extends DbFinder
{
  protected $class = 'Article';
  public $test_value = 0;
  
  public function initialize()
  {
    $this->test_value = 1;
  }
  
  public function published()
  {
    return $this;
  }
}

$finder = DbFinder::from('Article');
$t->ok($finder instanceof ArticleFinder, 'from() returns a custom finder if it exists');
$t->ok($finder instanceof DbFinder, 'from() accepts a finder class name if it exists');
$t->ok($finder->getAdapter() instanceof sfPropelFinder, 'from() accepts a finder class name if it exists');
$t->is($finder->getAdapter()->getClass(), 'Article', 'from() accepts a finder class name if it exists');
try
{
  $finder->published();
  $t->pass('Custom finder methods can be called on a DbFinder initialized with a finder name');
}
catch(Exception $e)
{
  $t->fail('Custom finder methods can be called on a DbFinder initialized with a finder name');
}

class myArticleFinder extends DbFinder
{
  protected $class = 'Article';
}

$finder = DbFinder::from('myArticle');
$t->ok($finder instanceof myArticleFinder, 'A class extending DbFinder can have any name');
$t->ok($finder->getAdapter() instanceof sfPropelFinder, 'A class extending DbFinder can have any name');
$t->is($finder->getAdapter()->getClass(), 'Article', 'A class extending DbFinder can have any name');

$finder = DbFinder::fromCollection(array($article2));
$t->ok($finder instanceof ArticleFinder, 'fromCollection() returns a custom finder if it exists');
$article = $finder->findOne();
$t->is($article->getId(), $article2Id, 'fromCollection() works on custom finders');

$finder = DbFinder::from('Article');
$t->is($finder->test_value, 1, 'initialize() is automatically executed at initialization on custom finders');
$finder = new ArticleFinder();
$t->is($finder->test_value, 1, 'initialize() is automatically executed at initialization on custom finders');

class myDbFinder extends DbFinder
{
}

$finder = myDbFinder::from('Comment');
$t->ok(!$finder instanceof myDbFinder, 'Late static binding prevents deriving directly from DbFinder');

class myCommentFinder extends myDbFinder
{
  
}

$finder = DbFinder::from('myComment');
$t->ok($finder instanceof myDbFinder, 'Creating custom model finders allows for extension of the finder');