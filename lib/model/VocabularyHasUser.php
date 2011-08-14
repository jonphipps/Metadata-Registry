<?php

/**
 * Subclass for representing a row from the 'reg_vocabulary_has_user' table.
 *
 *
 *
 * @package lib.model
 */
class VocabularyHasUser extends BaseVocabularyHasUser
{
  /**
  * overrides the parent save function
  *
  */
  public function save($con = null)
  {
    $saved = parent::save();

    //update the credentials
    $user = sfContext::getInstance()->getUser();
    $userId = $user->getAttribute('subscriber_id','','subscriber');
    $vocabUser = $this->getUserId();

    if ($saved && $vocabUser == $userId)
    {
      $user->setVocabularyCredentials();
    }

    return $saved;
  }
} // VocabularyHasUser
