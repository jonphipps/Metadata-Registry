<?php

/**
 * updatedb batch script
 *
 * This script is used to update the database data as needed
 *
 * @package    registry
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

//debugbreak();

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here
$foo = new ConceptPropertyPeer();
$selectCriteria = new Criteria(ConceptPropertyPeer::DATABASE_NAME);
$rs = $foo->doSelect($selectCriteria);
$count = $foo->doCount($selectCriteria);
$counter = 0;
/**  @var ConceptProperty $property  */
foreach ($rs as $property)
{
  //debugbreak();
  $counter++;
//  $conceptCol = $property->getConceptsJoinVocabulary();
  $concept = $property->getConceptRelatedByConceptId();
  $criteria = new Criteria();
  $criteria->add(VocabularyHasUserPeer::IS_REGISTRAR_FOR, true);
  $users = $property->getConceptRelatedByConceptId()->getVocabulary()->getVocabularyHasUsersJoinUser($criteria);
  if (count($users))
  {
/**  @var VocabularyHasUser $user  */
    $user = $users[0]->getUser();
    $userId = $user->getId();
    $property->setUpdatedUserId($userId);
    $property->setCreatedUserId($userId);
  }

  if (!$property->getLanguage())
  {
    $property->setLanguage('en');
  }

  if (!$property->getStatusId())
  {
    $property->setStatusId(1);
  }

  $property->save();
  echo($counter . ' of ' . $count) ."\n";

}