<?php

/**
 * Subclass for representing a row from the 'reg_vocabulary' table.
 *
 *
 *
 * @package lib.model
 */
class Vocabulary extends BaseVocabulary
{
  public function __toString() {

    return $this->getName();
  }

  public function getLanguageForSelect() {
    return array($this->getLanguage() => format_language($this->getLanguage()));
  }
  /**
   * Get the [languages] column value.
   *
   * @return     string
   */
  public function getLanguages()
  {
    return (! is_null($this->languages)) ? unserialize($this->languages) : $this->languages;
  }
  /**
   * Set the value of [languages] column.
   *
   * @param      string $v new value
   *
   * @return     void
   */
  public function setLanguages($v)
  {
    // Since the native PHP type for this column is string,
    // we will serialize the input to a string (if it is not).
    if ($v !== null) {
      $v = serialize($v);
    }
    parent::setLanguages($v);
  } // setLanguages()
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
      if ($userId && $vocabularyId)
      {
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

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    $user = $this->getUserRelatedByCreatedUserId();
    if ($user)
    {
      return $user->getUser();
    }

  } // getCreatedUser

  /**
  * Gets the updated_by_user
  *
  * @return User
  */
  public function getUpdatedUser()
  {
    $user = $this->getUserRelatedByUpdatedUserId();
    if ($user)
    {
      return $user->getUser();
    }

  } // getUpdatedUser

}
