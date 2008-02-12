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

    if ($saved)
    {
      //make the credential array
      $credentials = array(
      registrar  => $this->getIsRegistrarFor(),
      admin      => $this->getIsAdminFor(),
      maintainer => $this->getIsMaintainerFor());

      sfContext::getInstance()->getUser()-> updateObjectCredential($this->getVocabularyId(),'vocabulary', $credentials);
    }
  }
} // VocabularyHasUser
