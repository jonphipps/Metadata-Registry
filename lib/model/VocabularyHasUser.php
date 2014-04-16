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

  public function getLanguagesForVocabulary()
  {
    return $this->getVocabulary()->getLanguages();
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
}
