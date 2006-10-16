<?php

require_once 'model/om/BaseVocabulary.php';


/**
 * Skeleton subclass for representing a row from the 'reg_vocabulary' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Vocabulary extends BaseVocabulary {
  public function __toString() {

    return $this->getName();
  }

  public function getMyAgentId() {
    //
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $criteria = new Criteria();
	  $criteria->add(VocabularyHasUserPeer::USER_ID, $userId);
    $userAgents = AgentHasUserPeer::doSelectJoinAgent($criteria);
    foreach ($userAgents as $agent) {
      $agents[] = $agent->getAgent();
    }

    return $agents;
  }

  public function save($con = null)
  {
    $con = Propel::getConnection();
    try
    {
      $con->begin();

      $ret = parent::save($con);

      // update vocabulary_has_user table
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $vocabularyId = $this->getId();
      $mode = sfContext::getInstance()->getRequest()->getParameter('action');

      //see if there's already an entry in the table and if not, add it
      $criteria = new Criteria();
		$criteria->add(VocabularyHasUserPeer::USER_ID, $userId);
      $VocabularyHasUsersColl = $this->getVocabularyHasUsers($criteria, $con);
      if (!count($VocabularyHasUsersColl))
      {
        $vocabularyUser = new VocabularyHasUser();
        $vocabularyUser->setVocabularyId($vocabularyId);
        $vocabularyUser->setUserId($userId);
        $vocabularyUser->setIsRegistrarFor(true);
        $vocabularyUser->setIsAdminFor(true);
        $vocabularyUser->setIsMaintainerFor(true);
        $vocabularyUser->save($con);
      }

      $con->commit();

      return $ret;

    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

}