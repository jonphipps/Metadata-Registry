<?php

/**
 * schemauser actions.
 *
 * @package    registry
 * @subpackage schemauser
 * @author     Jon Phipps <jonphipps@gmail.com>
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class schemauserActions extends autoschemauserActions
{
  public function preExecute ()
  {
    //we'll test this in several places to see if there are available new users
    //if (!$this->hasFlash('newUsers'))
    //{
      $this->setFlash('newUsers', UserPeer::getNewUsersForSchema());
    //}
    parent::preExecute();
  }
  /**
  * setDefaults
  *
  * @param  SchemaHasUser $SchemaHasUser
  */
  public function setDefaults($SchemaHasUser)
  {
    if (!isset($this->schema))
    {
      $this->schema = myActionTools::findCurrentSchema();
    }
    if ($this->schema)
    {
      $SchemaHasUser->setSchemaId($this->schema->getId());
    }

    $SchemaHasUser->setIsRegistrarFor(false);

    parent::setDefaults($SchemaHasUser);
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
    $user_id = $this->getUser()->getAttribute('user_id','','sf_admin/schema_has_user/filters');
    $schema_id = $this->getUser()->getAttribute('schema_id','','sf_admin/schema_has_user/filters');
    if ($user_id)
    {
      $this->redirectFilter = '?user_id='. strval($user_id);
    }
    elseif ($schema_id)
    {
      $this->redirectFilter = '?schema_id='. strval($schema_id);
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
      //a current schema is required
      $schema = myActionTools::requireSchemaFilter();
    }

    parent::executeList();
  }
}
