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

$t = new lime_test(7, new lime_output_color());

$t->diag('findRelation()');

try
{
  $relation = sfDoctrineFinder::from('DPerson')->findRelation('BlabBlah');
  $t->fail('findRelation() throws an exception when relation cannot be found');
}
catch(Exception $e)
{
  $t->pass('findRelation() throws an exception when relation cannot be found');
}
$relation = sfDoctrineFinder::from('DPerson')->findRelation('DClub');
$t->isa_ok($relation, 'Doctrine_Relation_LocalKey', 'findRelation() can find a relation from the related class name');
$relation = sfDoctrineFinder::from('DPerson')->findRelation('Club');
$t->isa_ok($relation, 'Doctrine_Relation_LocalKey', 'findRelation() can find a relation from the relation name');

$relation = sfDoctrineFinder::from('DPerson')->findRelation('DCivility');
$t->isa_ok($relation, 'Doctrine_Relation_LocalKey', 'findRelation() can find a relation for many-to-one relationships');
$relation = sfDoctrineFinder::from('DCivility')->findRelation('DPerson');
$t->isa_ok($relation, 'Doctrine_Relation_ForeignKey', 'findRelation() can find a relation for one_to_many relationships');

try
{
  $finder = sfDoctrineFinder::from('DArticle');
  $finder->findRelation('DAuthor');
  $t->fail('findRelation() cannot find a relation to a class with no declared relation');
}
catch(Exception $e)
{
  $t->pass('findRelation() cannot find a relation to a class with no declared relation');
}
try
{
  $finder = sfDoctrineFinder::from('DArticle');
  $finder->findRelation('DComment');
  $finder->findRelation('DAuthor');
  $t->pass('findRelation() can find a relation via another previously declared relation');
}
catch(Exception $e)
{
  $t->pass('findRelation() can find a relation via another previously declared relation');
}


