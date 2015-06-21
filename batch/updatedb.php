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


// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here

//get the vocabularies
$foo = new VocabularyPeer();
$selectCriteria = new Criteria(VocabularyPeer::DATABASE_NAME);
$rs = $foo->doSelect($selectCriteria);
$vocabCount = $foo->doCount($selectCriteria);
$vocabCounter = 0;

//foreach vocabulary
/** @var Vocabulary $vocavulary **/
foreach ($rs as $vocabulary)
{
  $vocabCounter++;

  //get the vocabulary registrar
  $userCriteria = new Criteria();
  $userCriteria->add(VocabularyHasUserPeer::IS_REGISTRAR_FOR, true);
  $users = $vocabulary->getVocabularyHasUsersJoinUser($userCriteria);
  if (count($users))
  {
    /**  @var VocabularyHasUser $user  */
    $user = $users[0]->getUser();
    $userId = $user->getId();
  }
  //created_user_id <== "use id of vocabulary registrar"
  $vocabulary->setCreatedUserId($userId);
  //updated_user_id <== "use id of vocabulary registrar"
  $vocabulary->setUpdatedUserId($userId);
  //update the vocabulary
  $vocabulary->save();

  //get the vocabulary concepts
  $concepts = $vocabulary->getConcepts();
  $conceptCount = count($concepts);
  $conceptCounter = 0;
  //foreach concept
  /** @var Concept $concept **/
  foreach ($concepts as $concept)
  {
    $conceptCounter++;

    //updated_at <== last_updated
    $concept->setUpdatedAt($concept->getLastUpdated());
    //created_user_id <== "use id of vocabulary registrar"
    $concept->setCreatedUserId($userId);
    //updated_user_id <== "use id of vocabulary registrar"
    $concept->setUpdatedUserId($userId);

    //get the concept properties
    /**  @var ConceptProperty $properties  */
    $properties = $concept->getConceptPropertysRelatedByConceptId();
    $propertyCount = count($properties);
    $propertyCounter = 0;
    //foreach property
    foreach ($properties as $property)
    {
      $propertyCounter++;

      //updated_at <== last_updated
      $property->setUpdatedAt($property->getLastUpdated());
      //created_user_id <== "use id of vocabulary registrar"
      $property->setCreatedUserId($userId);
      //updated_user_id <== "use id of vocabulary registrar"
      $property->setUpdatedUserId($userId);
      //eliminate null language
      if (!$property->getLanguage())
      {
        $property->setLanguage('en');
      }

      //eliminate null status
      if (!$property->getStatusId())
      {
        $property->setStatusId(1);
      }

      if ($property->getSkosPropertyId() == 19)
      {
        //pref_label_id <== "use id of preflabel, concept.language related to the concept, or join based on the pref_label string"
        $concept->setPrefLabelId($property->getId());
        $property->setPrimaryPrefLabel(true);
      }

      $property->save();

      echo("\r" . 'Voc: ' . str_pad($vocabCounter,5) . ' of ' . $vocabCount . '   Con: ' . str_pad($conceptCounter,5) . ' of ' . $conceptCount . '   Prop: ' . str_pad($propertyCounter,5) . ' of ' . $propertyCount);
    }

    //update the concept
    $concept->save();
  }
  //$vocabulary->save();
}

echo("Done!");