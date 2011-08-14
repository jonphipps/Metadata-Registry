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

    DHuman:
      columns:
        id:         { type: integer, primary: true }
        name:       string(255)
        father_id:  integer
        mother_id:  integer
      relations:
        Father:
          class:    DHuman
          local:    father_id
          foreign:  id
          onDelete: cascade
          type:     one
          foreignAlias: FatherChildren
        Mother:
          class:    DHuman
          local:    mother_id
          foreign:  id
          onDelete: cascade
          type:     one
          foreignAlias: MotherChildren

    DHouse:
      columns:
        id:         { type: integer, primary: true }
        name:       string(255)
        owner_id:   integer
        renter_id:  integer
      relations:
        Owner:
          class:    DHuman
          local:    owner_id
          foreign:  id
          onDelete: cascade
          type:     one
          foreignAlias: OwnedHouses
        Renter:
          class:    DHuman
          local:    renter_id
          foreign:  id
          onDelete: cascade
          type:     one
          foreignAlias: RentedHouses

Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(49, new lime_output_color());

/****************************************************************/
/* sfDoctrineFinder::join($class) and many-to-one relationships */ 
/****************************************************************/

$t->diag('sfDoctrineFinder::join($class) and many-to-one relationships');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();
$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new DArticle();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  where('DCategory.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join() allows to join to another table (many-to-one)');
$nbArticles = sfDoctrineFinder::from('DArticle')->
  where('DCategory.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join() can be omitted if column names are explicit (many-to-one)');
$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  where('DCategory.Name', 'cat2')->
  count();
$t->is($nbArticles, 1, 'join() allows to join to another table (many-to-one)');
$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  where('DCategory.Name', 'cat2')->
  count();
$t->is($nbArticles, 1, 'join() can be omitted if column names are explicit (many-to-one)');
$article = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  where('DCategory.Name', 'cat2')->
  findOne();
$t->is($article->getTitle(), 'ccccc', 'join() allows to join to another table (many-to-one)');

/****************************************************************/
/* sfDoctrineFinder::join($class) and one-to-many relationships */ 
/****************************************************************/

$t->diag('sfDoctrineFinder::join($class) and one-to-many relationships');

Doctrine_Query::create()->delete()->from('DArticle')->execute();

$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$comment = new DComment();
$comment->setContent('foo');
$comment->setArticleId($article2->getId());
$comment->save();
$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DComment')->
  where('DComment.Content', 'foo')->
  count();
$t->is($nbArticles, 1, 'join() allows to join to another table (one-to-many)');
$nbArticles = sfDoctrineFinder::from('DArticle')->
  where('DComment.Content', 'foo')->
  count();
$t->is($nbArticles, 1, 'join() can be omitted if column names are explicit (one-to-many)');
$article = sfDoctrineFinder::from('DArticle')->
  join('DComment')->
  where('DComment.Content', 'foo')->
  findOne();
$t->is($article->getTitle(), 'bbbbb', 'join() allows to join to another table (one-to-many)');

/*************************************/
/* sfDoctrineFinder::join($relation) */ 
/*************************************/

$t->diag('sfDoctrineFinder::join($relation)');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('Category')->
  where('Category.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join() accepts relation names instead of related class names');

/******************************************/
/* sfDoctrineFinder::join($classAndAlias) */ 
/******************************************/

$t->diag('sfDoctrineFinder::join($classAndAlias)');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory a')->
  where('a.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join() accepts class aliases');
$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('Category a')->
  where('a.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'Aliases used in join() can be used in where() afterwards');

/*****************************************/
/* sfDoctrineFinder::join($class, $type) */ 
/*****************************************/

$t->diag('sfDoctrineFinder::join($class, $type)');

$finder = sfDoctrineFinder::from('DArticle')->join('DCategory');
$finder->count();
$t->ok(stripos($finder->getLatestQuery(), 'inner join') !== false, 'join($class) defaults to an inner join');
$finder = sfDoctrineFinder::from('DArticle')->join('DCategory', 'left join');
$finder->count();
$t->ok(stripos($finder->getLatestQuery(), 'left join') !== false, 'join($class, $type) accepts a join type as second parameter (like "left join")');
$finder = sfDoctrineFinder::from('DArticle')->join('DCategory', Criteria::LEFT_JOIN);
$finder->count();
$t->ok(stripos($finder->getLatestQuery(), 'left join') !== false, 'join($class, $type) accepts a join type as second parameter (like "Criteria::LEFT_JOIN")');
$finder = sfDoctrineFinder::from('DArticle')->join('DCategory', 'left');
$finder->count();
$t->ok(stripos($finder->getLatestQuery(), 'left join') !== false, 'join($class, $type) accepts a join type as second parameter (like "left")');

/***********************************************/
/* sfDoctrineFinder::join($start, $end, $type) */ 
/***********************************************/

$t->diag('sfDoctrineFinder::join($start, $end, $type)');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DArticle.CategoryId', 'DCategory.Id', 'inner')->
  where('Category.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join($start, $end, $type) allows to join based on the two members of the relationship');
$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory.Id', 'DArticle.CategoryId', 'inner')->
  where('Category.Name', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join($end, $start, $type) allows to join based on the two members of the relationship');

/****************************************/
/* leftJoin(), rightJoin(), innerJoin() */ 
/****************************************/

$t->diag('leftJoin(), rightJoin(), innerJoin()');

$finder = sfDoctrineFinder::from('DArticle')->leftJoin('DComment');
$t->is($finder->getQueryObject()->getDQL(), 'SELECT DArticle.* FROM DArticle  LEFT JOIN DArticle.DComment d', 'leftJoin($class) ends up in a left join');
//$finder = sfDoctrineFinder::from('DArticle')->rightJoin('DComment');
$t->skip('rightJoin($class) ends up in a right join');
$finder = sfDoctrineFinder::from('DArticle')->innerJoin('DComment');
$t->is($finder->getQueryObject()->getDQL(), 'SELECT DArticle.* FROM DArticle  INNER JOIN DArticle.DComment d', 'innerJoin($table) ends up in an inner join');

$finder = sfDoctrineFinder::from('DArticle')->leftJoin('DArticle.Id', 'DComment.ArticleId');
$t->is($finder->getQueryObject()->getDQL(), 'SELECT DArticle.* FROM DArticle  LEFT JOIN DArticle.DComment ', 'leftJoin($start, $end) creates left join');

/*********************************************************************/
/* sfDoctrineFinder::join($class) and subsequent finder method calls */ 
/*********************************************************************/

$t->diag('sfDoctrineFinder::join($class) and subsequent finder method calls');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();
$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new DArticle();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  where('DCategory.Name', 'cat1')->
  orWhere('DCategory.Name', 'cat2')->
  count();
$t->is($nbArticles, 3, 'join($class) allows columns of joined table to be used in orWhere()');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  whereCustom('DCategory.Name = ?', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join($class) allows columns of joined table to be used in whereCustom()');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  where('DCategory.Name', 'cat1')->
  orWhereCustom('DCategory.Name = ?', 'cat2')->
  count();
$t->is($nbArticles, 3, 'join($class) allows columns of joined table to be used in orWhereCustom()');

$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  orderBy('DCategory.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id ORDER BY d2.name ASC', 'join($class) allows columns of joined table to be used in orderBy()');

$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory')->
  groupBy('DCategory.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id GROUP BY d2.name', 'join($class) allows columns of joined table to be used in groupBy()');

/*****************************************************************************/
/* sfDoctrineFinder::join($classAndAlias) and subsequent finder method calls */ 
/*****************************************************************************/

$t->diag('sfDoctrineFinder::join($classAndAlias) and subsequent finder method calls');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
Doctrine_Query::create()->delete()->from('DAuthor')->execute();

$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();
$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new DArticle();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory c')->
  where('c.Name', 'cat1')->
  orWhere('c.Name', 'cat2')->
  count();
$t->is($nbArticles, 3, 'join($classAndAlias) allows columns of joined table to be used in orWhere()');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory c')->
  whereCustom('c.Name = ?', 'cat1')->
  count();
$t->is($nbArticles, 2, 'join($classAndAlias) allows columns of joined table to be used in whereCustom()');

$nbArticles = sfDoctrineFinder::from('DArticle')->
  join('DCategory c')->
  where('c.Name', 'cat1')->
  orWhereCustom('c.Name = ?', 'cat2')->
  count();
$t->is($nbArticles, 3, 'join($classAndAlias) allows columns of joined table to be used in orWhereCustom()');

$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory c')->
  orderBy('c.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id ORDER BY d2.name ASC', 'join($classAndAlias) allows columns of joined table to be used in orderBy()');

$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory c')->
  groupBy('c.Name');
$finder->find();
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id GROUP BY d2.name', 'join($classAndAlias) allows columns of joined table to be used in groupBy()');

/**************************************************************************************/
/* sfDoctrineFinder::join($classAndAlias, $start, $end, $type) and subsequent where() */
/**************************************************************************************/

$t->diag('sfDoctrineFinder::join($classAndAlias, $start, $end, $type) and subsequent where()');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
Doctrine_Query::create()->delete()->from('DCategory')->execute();
$category1 = new DCategory();
$category1->setName('cat1');
$category1->save();
$category2 = new DCategory();
$category2->setName('cat2');
$category2->save();
$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$article3 = new DArticle();
$article3->setTitle('ccccc');
$article3->setCategory($category2);
$article3->save();
$finder = sfDoctrineFinder::from('DArticle')->
  join('DCategory c', 'DArticle.CategoryId', 'c.Id', 'INNER JOIN')->
  where('c.Name', 'cat1');
$articles = $finder->find();
$t->is(count($articles), 2, 'join() allows to join to another table using an alias (many-to-one)');
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d INNER JOIN d_category d2 ON d.category_id = d2.id WHERE d2.name = \'cat1\'', 'join() uses aliased table names when using an alias relation');

Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();
$article1 = new DArticle();
$article1->setTitle('aaaaa');
$article1->setCategory($category1);
$article1->save();
$article2 = new DArticle();
$article2->setTitle('bbbbb');
$article2->setCategory($category1);
$article2->save();
$comment = new DComment();
$comment->setContent('foo');
$comment->setArticleId($article2->getId());
$comment->save();
$finder = sfDoctrineFinder::from('DArticle')->
  join('DComment c', 'DArticle.Id', 'c.ArticleId', 'INNER JOIN')->
  where('c.Content', 'foo');
$articles = $finder->find();
$t->is(count($articles), 1, 'join() allows to join to another table using an alias (one-to-many)');
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.title AS d__title, d.category_id AS d__category_id FROM d_article d INNER JOIN d_comment d2 ON d.id = d2.article_id WHERE d2.content = \'foo\'', 'join() uses aliased table names when using an alias relation');

/***********************************************************************/
/* sfDoctrineFinder::join() with multiple foreign keys to the same table */
/***********************************************************************/

$t->diag('sfDoctrineFinder::join() with multiple foreign keys to the same table');

Doctrine_Query::create()->delete()->from('DHuman')->execute();
Doctrine_Query::create()->delete()->from('DHouse')->execute();
$human1 = new DHuman();
$human1->setName('John');
$human1->save();
$human2 = new DHuman();
$human2->setName('Jane');
$human2->save();
$house1 = new DHouse();
$house1->setName('Home1');
$house1->setOwnerId($human1->getId());
$house1->setRenterId($human2->getId());
$house1->save();
$house2 = new DHouse();
$house2->setName('Home2');
$house2->setOwnerId($human2->getId());
$house2->setRenterId($human1->getId());
$house2->save();
$finder = sfDoctrineFinder::from('DHouse')->
  join('DHuman owner', 'DHouse.OwnerId', 'owner.Id', 'INNER JOIN')->
  where('owner.Name', 'John');
$houses = $finder->find();
$t->is(count($houses), 1, 'join() allows to join to another table with several foreign keys using an alias');
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name, d.owner_id AS d__owner_id, d.renter_id AS d__renter_id FROM d_house d INNER JOIN d_human d2 ON d.owner_id = d2.id WHERE d2.name = \'John\'', 'join() uses aliased table names when using an alias relation');

/************************************************************/
/* sfDoctrineFinder::join() with self-referenced foreign keys */
/************************************************************/

$t->diag('sfDoctrineFinder::join() with self-referenced foreign keys');

Doctrine_Query::create()->delete()->from('DHuman')->execute();
$human1 = new DHuman();
$human1->setName('John');
$human1->save();
$human2 = new DHuman();
$human2->setName('Albert');
$human2->setFather($human1);
$human2->save();
$finder = sfDoctrineFinder::from('DHuman')->
  join('DHuman father', 'DHuman.FatherId', 'father.Id', 'INNER JOIN')->
  where('father.Name', 'John');
$humans = $finder->find();
$t->is(count($humans), 1, 'join() allows to join to the current table using an alias');
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name, d.father_id AS d__father_id, d.mother_id AS d__mother_id FROM d_human d INNER JOIN d_human d2 ON d.father_id = d2.id WHERE d2.name = \'John\'', 'join() uses aliased table names when using an alias relation');

/*********************************************************************/
/* sfDoctrineFinder::join() with multiple self-referenced foreign keys */
/*********************************************************************/

$t->diag('sfDoctrineFinder::join() with multiple self-referenced foreign keys');

Doctrine_Query::create()->delete()->from('DHuman')->execute();
$human1 = new DHuman();
$human1->setName('John');
$human1->save();
$human2 = new DHuman();
$human2->setName('Jane');
$human2->save();
$human3 = new DHuman();
$human3->setName('Albert');
$human3->setFather($human1);
$human3->setMother($human2);
$human3->save();

$finder = sfDoctrineFinder::from('DHuman')->
  join('DHuman father', 'DHuman.FatherId', 'father.Id', 'INNER JOIN')->
  join('DHuman mother', 'DHuman.MotherId', 'mother.Id', 'INNER JOIN')->
  where('father.Name', 'John')->
  where('mother.Name', 'Jane');
$humans = $finder->find();
$t->is(count($humans), 1, 'join() allows to join to the current table with several foreign keys using an alias');
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name, d.father_id AS d__father_id, d.mother_id AS d__mother_id FROM d_human d INNER JOIN d_human d2 ON d.father_id = d2.id INNER JOIN d_human d3 ON d.mother_id = d3.id WHERE (d2.name = \'John\' AND d3.name = \'Jane\')', 'join() uses aliased table names when using an alias relation');

Doctrine_Query::create()->delete()->from('DHuman')->execute();
$human1 = new DHuman();
$human1->setName('John');
$human1->save();
$human2 = new DHuman();
$human2->setName('Albert');
$human2->setFather($human1);
$human2->save();
$human3 = new DHuman();
$human3->setName('Jane');
$human3->setFather($human2);
$human3->save();

$finder = sfDoctrineFinder::from('DHuman')->
  join('DHuman father', 'DHuman.FatherId', 'father.Id', 'INNER JOIN')->
  join('DHuman grandfather', 'father.FatherId', 'grandfather.Id', 'INNER JOIN')->
  where('grandfather.Name', 'John');
$humans = $finder->find();
$t->is(count($humans), 1, 'join() allows to join to the current table with several foreign keys using an alias');
$t->is($finder->getLatestQuery(), 'SELECT d.id AS d__id, d.name AS d__name, d.father_id AS d__father_id, d.mother_id AS d__mother_id FROM d_human d INNER JOIN d_human d2 ON d.father_id = d2.id INNER JOIN d_human d3 ON d2.father_id = d3.id WHERE d3.name = \'John\'', 'join() uses aliased table names when using an alias relation');

/******************************************/
/* sfDoctrineFinder::join() and relations */ 
/******************************************/

$t->diag('sfDoctrineFinder::join() and relations');

Doctrine_Query::create()->delete()->from('DAuthor')->execute();
Doctrine_Query::create()->delete()->from('DComment')->execute();
Doctrine_Query::create()->delete()->from('DArticle')->execute();

$article1 = new DArticle();
$article1->setTitle('aaaaa');
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
$article = sfDoctrineFinder::from('DArticle')->
  join('DComment')->
  join('DAuthor')->
  where('DAuthor.Name', 'John')->
  findOne();
$t->is($article->getTitle(), 'aaaaa', 'you can chain several join() statements');
$article = sfDoctrineFinder::from('DArticle')->join('DComment')->where('DAuthor.Name', 'John')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'join() can be omitted if column names are explicit');
$article = sfDoctrineFinder::from('DArticle')->joinDComment()->joinDAuthor()->where('DAuthor.Name', 'John')->findOne();
$t->is($article->getTitle(), 'aaaaa', 'joinXXX() does a join according to the XXX column name');

$comment = sfDoctrineFinder::from('DComment')->join('DArticle')->join('DAuthor')->where('DAuthor.Name', 'John')->findOne();
$t->is($comment->getContent(), 'foo', 'you can add several join() statements');
$t->is($comment->getArticle()->getTitle(), 'aaaaa', 'you can add several join() statements');
$t->is($comment->getAuthor()->getName(), 'John', 'you can add several join() statements');
