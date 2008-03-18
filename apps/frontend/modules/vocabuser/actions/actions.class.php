<?php

/**
 * vocabuser actions.
 *
 * @package    registry
 * @subpackage vocabuser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 63 2006-06-14 17:31:15Z jphipps $
 */
class vocabuserActions extends autovocabuserActions
{
  public function preExecute ()
  {
    //we'll test this in several places to see if there are available new users
    $this->setFlash('newUsers', UserPeer::getNewUsersForVocabulary());
    parent::preExecute();
  }
  /**
  * setDefaults
  *
  * @param  VocabularyHasUser $VocabularyHasUser
  */
  public function setDefaults($VocabularyHasUser)
  {
    $vocabulary = myActionTools::findCurrentVocabulary();
    if ($vocabulary)
    {
      $VocabularyHasUser->setVocabularyId($vocabulary->getId());
    }

    $VocabularyHasUser->setIsRegistrarFor(false);

    parent::setDefaults($VocabularyHasUser);
  }

  public function executeCancel()
  {
    $this->setFilter();
    parent::executeCancel();
  }

  public function executeDelete()
  {
    $this->setFilter();
    parent::executeDelete();
  }

  private function setFilter()
  {
    $user_id = $this->getUser()->getAttribute('user_id','','sf_admin/vocabulary_has_user/filters');
    $vocabulary_id = $this->getUser()->getAttribute('vocabulary_id','','sf_admin/vocabulary_has_user/filters');
    if ($user_id)
    {
      $this->redirectFilter = '?user_id='. strval($user_id);
    }
    elseif ($vocabulary_id)
    {
      $this->redirectFilter = '?vocabulary_id='. strval($vocabulary_id);
    }
  }

  /**
  * overrides the parent executeList function
  *
  */
  public function executeList()
  {
    if (!$this->hasRequestParameter('user_id')) //we're not filtering by user
    {
      //a current vocabulary is required
      myActionTools::requireVocabularyFilter();
    }

    parent::executeList();
  }
}
