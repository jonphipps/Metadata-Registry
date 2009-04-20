<?php

/**
 * Subclass for representing a row from the 'schema_has_user' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaHasUser extends BaseSchemaHasUser
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
    $schemaUser = $this->getUserId();

    if ($saved && $schemaUser == $userId)
    {
      $user->setSchemaCredentials();
    }

    return $saved;
  }

}
