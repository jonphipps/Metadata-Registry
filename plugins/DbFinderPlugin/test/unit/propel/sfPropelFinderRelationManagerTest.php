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
                
Beware that the tables for these models will be emptied by the tests, so use a test database connection.
*/

include dirname(__FILE__).'/../../bootstrap.php';

// cleanup database
CommentPeer::doDeleteAll();
ArticlePeer::doDeleteAll();

$t = new lime_test(49, new lime_output_color());

/*************************************************/
/* sfPropelFinderRelationManager::findRelation() */
/*************************************************/

$t->diag('sfPropelFinderRelationManager::findRelation()');

$manager = new sfPropelFinderRelationManager('Article');
$t->is($manager->findRelation('Category', 'Author'), false, 'findRelation() returns false when no relation exist between two classes');
$t->is($manager->findRelation('Category', 'Article'), false, 'findRelation() returns false when no direct relation exist between two classes');
$relation = $manager->findRelation('Article', 'Category');
$t->isa_ok($relation, 'sfPropelFinderRelation', 'findRelation() returns a sfPropelFinderRelation instance when a direct relation exist between two classes');
$t->is($relation->getFromClass(), 'Article', 'findRelation() returns a relation starting at the $fromClass');
$t->is($relation->getFromColumn(), ArticlePeer::CATEGORY_ID, 'findRelation() returns a relation where $fromColumn is correctly guessed');
$t->is($relation->getToClass(), 'Category', 'findRelation() returns a relation ending at the $toClass');
$t->is($relation->getToColumn(), CategoryPeer::ID, 'findRelation() returns a relation where $toColumn is correctly guessed');
$t->is($relation->getType(), sfPropelFinderRelation::MANY_TO_ONE, 'findRelation() returns a relation where $type is correctly guessed');

/***************************************************************************/
/* sfPropelFinderRelationManager::guessRelation() and direct relationships */
/***************************************************************************/

$t->diag('sfPropelFinderRelationManager::guessRelation() and direct relationships');

$manager = new sfPropelFinderRelationManager('Article');
try
{
  $manager->guessRelation('Author');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, true, 'guessRelation() throws an exception when no relation can be found');

$manager = new sfPropelFinderRelationManager('Article');
try
{
  $relation = $manager->guessRelation('Category');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses many-to-one relationhips');
$t->isa_ok($relation, 'sfPropelFinderRelation', 'guessRelation() returns a sfPropelFinderRelation instance when the relationship is found');
$t->is($relation->getFromClass(), 'Article', 'guessRelation() returns a relation object starting at the original class');
$t->is($relation->getFromColumn(), ArticlePeer::CATEGORY_ID, 'guessRelation() returns a relation object with the correct $fromColumn');
$t->is($relation->getToClass(), 'Category', 'guessRelation() returns a relation object ending at the given class');
$t->is($relation->getToColumn(), CategoryPeer::ID, 'guessRelation() returns a relation object with the correct $toColumn');
$t->is($relation->getType(), sfPropelFinderRelation::MANY_TO_ONE, 'findRelation() returns a relation correctly qualified');


$manager = new sfPropelFinderRelationManager('Article');
try
{
  $relation = $manager->guessRelation('Comment');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses one-to-many relationhips');
$t->isa_ok($relation, 'sfPropelFinderRelation', 'guessRelation() returns a sfPropelFinderRelation instance when the relationship is found');
$t->is($relation->getFromClass(), 'Article', 'guessRelation() returns a relation object starting at the original class');
$t->is($relation->getFromColumn(), ArticlePeer::ID, 'guessRelation() returns a relation object with the correct $fromColumn');
$t->is($relation->getToClass(), 'Comment', 'guessRelation() returns a relation object ending at the given class');
$t->is($relation->getToColumn(), CommentPeer::ARTICLE_ID, 'guessRelation() returns a relation object with the correct $toColumn');
$t->is($relation->getType(), sfPropelFinderRelation::ONE_TO_MANY, 'findRelation() returns a relation correctly qualified');


/*****************************************************************************/
/* sfPropelFinderRelationManager::guessRelation() and indirect relationships */
/*****************************************************************************/

$t->diag('sfPropelFinderRelationManager::guessRelation() and indirect relationships');

$manager = new sfPropelFinderRelationManager('Article');
$manager[] = $manager->guessRelation('Comment');
try
{
  $relation = $manager->guessRelation('Author');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses relationships via already related classes (one-to-many, many-to-one)');
$t->is($relation->getFromClass(), 'Comment', 'guessRelation() returns a relation object starting at the correct class');
$t->is($relation->getToClass(), 'Author', 'guessRelation() returns a relation object ending at the given class');
$t->isa_ok($relation->getPreviousRelation(), 'sfPropelFinderRelation', 'guessRelation() returns a relation object keeping track of the previous relation');

$manager = new sfPropelFinderRelationManager('Category');
$manager[] = $manager->guessRelation('Article');
try
{
  $relation = $manager->guessRelation('Comment');
  $manager[] = $relation;
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses relationships via already related classes(one-to-many, one-to-many)');
$t->is($relation->getFromClass(), 'Article', 'guessRelation() returns a relation object starting at the correct class');
$t->is($relation->getToClass(), 'Comment', 'guessRelation() returns a relation object ending at the given class');
$t->isa_ok($relation->getPreviousRelation(), 'sfPropelFinderRelation', 'guessRelation() returns a relation object keeping track of the previous relation');

$manager = new sfPropelFinderRelationManager('Comment');
$manager[] = $manager->guessRelation('Article');
try
{
  $relation = $manager->guessRelation('Category');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses relationships via already related classes (many-to-one, many-to-one)');
$t->is($relation->getFromClass(), 'Article', 'guessRelation() returns a relation object starting at the correct class');
$t->is($relation->getToClass(), 'Category', 'guessRelation() returns a relation object ending at the given class');
$t->isa_ok($relation->getPreviousRelation(), 'sfPropelFinderRelation', 'guessRelation() returns a relation object keeping track of the previous relation');

$manager = new sfPropelFinderRelationManager('Comment');
$manager[] = $manager->guessRelation('Article');
try
{
  $relation = $manager->guessRelation('ArticleI18n');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses relationships via already related classes (many-to-one, one-to-many)');
$t->is($relation->getFromClass(), 'Article', 'guessRelation() returns a relation object starting at the correct class');
$t->is($relation->getToClass(), 'ArticleI18n', 'guessRelation() returns a relation object ending at the given class');
$t->isa_ok($relation->getPreviousRelation(), 'sfPropelFinderRelation', 'guessRelation() returns a relation object keeping track of the previous relation');

$manager = new sfPropelFinderRelationManager('Author');
$manager[] = $manager->guessRelation('Comment');
$manager[] = $manager->guessRelation('Article');
try
{
  $relation = $manager->guessRelation('Category');
  $exceptionThrown = false;
}
catch (Exception $e)
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() guesses relationships via already related classes (2 steps)');

/*****************************************************************************/
/* sfPropelFinderRelationManager::guessRelation() and unusual class phpNames */
/*****************************************************************************/

$t->diag('sfPropelFinderRelationManager::guessRelation() and unusual class phpNames');

$manager = new sfPropelFinderRelationManager('Person');
try 
{
  $manager->guessRelation('Club');
  $exceptionThrown = false;
} 
catch (Exception $e) 
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() can find a relation when the local name is not foreign_table_id');

try 
{
  $manager->guessRelation('Civility');
  $exceptionThrown = false;
} 
catch (Exception $e) 
{
  $exceptionThrown = true;
}
$t->is($exceptionThrown, false, 'guessRelation() can find a relation when the foreign phpName is not the camelCase version of the foreign Tablename');


/*********************************************************/
/* sfPropelFinderRelationManager::addRelationFromClass() */
/*********************************************************/

$t->diag('sfPropelFinderRelationManager::addRelationFromClass()');

$manager = new sfPropelFinderRelationManager('Article');

$ret = $manager->addRelationFromClass('Comment');
$t->isa_ok($ret, 'sfPropelFinderRelation', 'addRelationFromClass() returns a relation object when a relationship is added');
$relations = $manager->getRelations();
$t->is(count($relations), 1, 'addRelationFromClass() adds the relation to the manager relations array');
$keys = array_keys($relations);
$t->is(array_pop($keys), 'Comment', 'addRelationFromClass() adds the relation using the related class as an index');

$ret = $manager->addRelationFromClass('Author');
$relations = $manager->getRelations();
$t->is(count($relations), 2, 'addRelationFromClass() adds the relation to the manager relations array');
$keys = array_keys($relations);
$t->is(array_pop($keys), 'Author', 'addRelationFromClass() adds the relation using the related class as an index');

$ret = $manager->addRelationFromClass('Author');
$t->is($ret, false, 'addRelationFromClass() returns false when no new relationship is found');
$t->is(count($manager->getRelations()), 2, 'addRelationFromClass() leaves the manager relations array unchanged when no new relationship is found');
