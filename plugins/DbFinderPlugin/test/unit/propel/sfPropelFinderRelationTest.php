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
        the_sex:   { type: integer, foreignTable: sex, foreignReference: id, onDelete: cascade }

      house:
        id:
        name: varchar(255)
        owner_id: { type: integer, foreignTable: human, foreignReference: id }
        renter_id: { type: integer, foreignTable: human, foreignReference: id }
                
Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

$t = new lime_test(18, new lime_output_color());

/*************************************************/
/* sfPropelFinderRelation::getObjectToRelate() */
/*************************************************/

$t->diag('sfPropelFinderRelation::getObjectToRelate()');

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
$comment1 = new Comment();
$comment1->setContent('foo');
$comment1->setArticleId($article1->getId());
$comment1->save();

$manager = new sfPropelFinderRelationManager('Comment');
$articleRelation = $manager->guessRelation('Article');
$manager[] = $articleRelation;
$categoryRelation = $manager->guessRelation('Category');
$manager[] = $categoryRelation;

$obj1 = $articleRelation->getObjectToRelate($comment1);
$t->isa_ok($obj1, 'Comment', 'getObjectToRelate() returns the object passed as parameter when the relation has no previous relation');
$obj2 = $categoryRelation->getObjectToRelate($comment1);
$t->isa_ok($obj2, 'Article', 'getObjectToRelate() returns a Propel model object');
$t->is($obj2->getTitle(), 'aaaaa', 'getObjectToRelate() returns the object resulting from the previous relation');

/*************************************************************************/
/* sfPropelFinderRelation::getObjectToRelate() and multiple foreign keys */
/*************************************************************************/

$t->diag('sfPropelFinderRelation::getObjectToRelate() and multiple foreign keys');

CivilityPeer::doDeleteAll();
HumanPeer::doDeleteAll();
HousePeer::doDeleteAll();
$civility1 = new Civility();
$civility1->setIsMan(true);
$civility1->save();
$human1 = new Human();
$human1->setName('John');
$human1->setCivility($civility1);
$human1->save();
$house1 = new House();
$house1->setName('Home1');
$house1->setHumanRelatedByOwnerId($human1);
$house1->save();

$manager = new sfPropelFinderRelationManager('House');
$ownerRelation = $manager->addRelationFromColumns('House', HousePeer::OWNER_ID, 'Human', HumanPeer::ID, 'owner');
$civilityRelation = $manager->guessRelation('Civility');
$manager[] = $civilityRelation;

$obj1 = $ownerRelation->getObjectToRelate($house1);
$t->isa_ok($obj1, 'House', 'getObjectToRelate() returns the object passed as parameter when the relation has no previous relation');
$obj2 = $civilityRelation->getObjectToRelate($house1);
$t->isa_ok($obj2, 'Human', 'getObjectToRelate() returns a Propel model object');
$t->is($obj2->getName(), 'John', 'getObjectToRelate() returns the object resulting from the previous relation');

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

$manager = new sfPropelFinderRelationManager('Human');
$fatherRelation = $manager->addRelationFromColumns('Human', HumanPeer::FATHER_ID, 'Human', HumanPeer::ID, 'father');
$grandFatherRelation = $manager->addRelationFromColumns('father', HumanPeer::FATHER_ID, 'Human', HumanPeer::ID, 'grandFather');

$obj1 = $fatherRelation->getObjectToRelate($human3);
$t->isa_ok($obj1, 'Human', 'getObjectToRelate() returns the object passed as parameter when the relation has no previous relation');
$obj2 = $grandFatherRelation->getObjectToRelate($human3);
$t->isa_ok($obj2, 'Human', 'getObjectToRelate() returns a Propel model object');
$t->is($obj2->getName(), 'Albert', 'getObjectToRelate() returns the object resulting from the previous relation');

/***********************************************************/
/* sfPropelFinderRelation::getObjectToRelate() and aliases */
/***********************************************************/

$t->diag('sfPropelFinderRelation::getObjectToRelate() and aliases');

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
$comment1 = new Comment();
$comment1->setContent('foo');
$comment1->setArticleId($article1->getId());
$comment1->save();

$manager = new sfPropelFinderRelationManager('Comment');
$articleRelation = $manager->guessRelation('Article');
$manager['a'] = $articleRelation;
$categoryRelation = $manager->addRelationFromColumns('a', ArticlePeer::CATEGORY_ID, 'Category', CategoryPeer::ID, 'c');

$obj1 = $articleRelation->getObjectToRelate($comment1);
$t->isa_ok($obj1, 'Comment', 'getObjectToRelate() returns the object passed as parameter when the relation has no previous relation');
$obj2 = $categoryRelation->getObjectToRelate($comment1);
$t->isa_ok($obj2, 'Article', 'getObjectToRelate() returns a Propel model object');
$t->is($obj2->getTitle(), 'aaaaa', 'getObjectToRelate() returns the object resulting from the previous relation');

/******************************************/
/* sfPropelFinderRelation::relateObject() */
/******************************************/

$t->diag('sfPropelFinderRelation::relateObject()');

CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();
CategoryPeer::doDeleteAll();

$category1 = new Category();
$category1->setName('cat1');
$category1->save();
$article1 = new Article();
$article1->setTitle('aaaaa');
$article1->save();
$comment1 = new Comment();
$comment1->setContent('foo');
$comment1->save();

$manager = new sfPropelFinderRelationManager('Comment');
$articleRelation = $manager->guessRelation('Article');
$manager[] = $articleRelation;
$categoryRelation = $manager->guessRelation('Category');
$manager[] = $categoryRelation;

$articleRelation->relateObject($comment1, $article1);
$t->is($comment1->getArticleId(), $article1->getId(), 'relateObject() creates a relation between two Propel objects');
$categoryRelation->relateObject($comment1, $category1);
$t->is($article1->getCategoryId(), $category1->getId(), 'relateObject() creates a relation between two Propel objects via another relation');

/********************************************************************/
/* sfPropelFinderRelation::relateObject() and multiple foreign keys */
/********************************************************************/

$t->diag('sfPropelFinderRelation::relateObject() and multiple foreign keys');

CivilityPeer::doDeleteAll();
HumanPeer::doDeleteAll();
HousePeer::doDeleteAll();
$civility1 = new Civility();
$civility1->setIsMan(true);
$civility1->save();
$human1 = new Human();
$human1->setName('John');
$human1->save();
$house1 = new House();
$house1->setName('Home1');
$house1->save();

$manager = new sfPropelFinderRelationManager('House');
$ownerRelation = $manager->addRelationFromColumns('House', HousePeer::OWNER_ID, 'Human', HumanPeer::ID, 'owner');
$civilityRelation = $manager->guessRelation('Civility');
$manager[] = $civilityRelation;

$ownerRelation->relateObject($house1, $human1);
$t->is($house1->getOwnerId(), $human1->getId(), 'relateObject() creates a relation between two Propel objects');
$civilityRelation->relateObject($house1, $civility1);
$t->is($human1->getTheSex(), $civility1->getId(), 'relateObject() creates a relation between two Propel objects via another relation');

/******************************************************/
/* sfPropelFinderRelation::relateObject() and aliases */
/******************************************************/

$t->diag('sfPropelFinderRelation::relateObject() and aliases');

HumanPeer::doDeleteAll();
$human1 = new Human();
$human1->setName('John');
$human1->save();
$human2 = new Human();
$human2->setName('Albert');
$human2->save();
$human3 = new Human();
$human3->setName('Jane');
$human3->save();

$manager = new sfPropelFinderRelationManager('Human');
$fatherRelation = $manager->addRelationFromColumns('Human', HumanPeer::FATHER_ID, 'Human', HumanPeer::ID, 'father');
$grandFatherRelation = $manager->addRelationFromColumns('father', HumanPeer::FATHER_ID, 'Human', HumanPeer::ID, 'grandFather');

$fatherRelation->relateObject($human3, $human2);
$t->is($human3->getFatherId(), $human2->getId(), 'relateObject() creates a relation between two Propel objects');
$grandFatherRelation->relateObject($human3, $human1);
$t->is($human2->getFatherId(), $human1->getId(), 'relateObject() creates a relation between two Propel objects via another relation');
