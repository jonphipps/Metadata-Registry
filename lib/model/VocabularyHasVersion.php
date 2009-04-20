<?php

/**
 * Subclass for representing a row from the 'reg_vocabulary_has_version' table.
 *
 *
 *
 * @package lib.model
 */
class VocabularyHasVersion extends BaseVocabularyHasVersion
{
  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    $user = $this->getUser();
    if ($user)
    {
      return $user;
    }

  } // getCreatedUser
}
