<?php

/**
 * Subclass for representing a row from the 'reg_schema_property_element' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyElement extends BaseSchemaPropertyElement
{
  public $importId;
  public $matchKey;
  public $importStatus;

  /**
  * description
  *
  * @return string
  */
  public function __toString()
  {
    return $this->getProfileProperty()->__toString();
  }

  /**
   * @return int
   */
  public function getProfileOrder() {
    return $this->getProfileProperty()->getDisplayOrder();
  }

  /**
   * description
   *
   * @return integer
   *
   * @param Connection $con
   * @param bool $reciprocal
   *
   * @throws Exception
   * @throws PropelException
   */
  public function save($con = null, $reciprocal = false)
  {
    if ($this->isModified())
    {
      if ($this->isNew())
      {
        $action = 'added';
      }
      //this is untested since we don't allow this kind of delete
      elseif ($this->isDeleted())
      {
        $action = 'force_deleted';
      }
      else
      {
        $action = 'updated';
      }

      //$property = $this->getSchemaPropertyRelatedBySchemaPropertyId();
      //$property->setUpdatedAt($this->getUpdatedAt());

      //continue with save
      $affectedRows = parent::save($con);

      //do the history
      $history = new SchemaPropertyElementHistory();

      if ($action == 'updated' && $this->getDeletedAt())
      {
        $action = 'deleted';
      }

      $history->setAction($action);
      $history->setProfilePropertyId($this->getProfilePropertyId());
      $history->setSchemaId($this->getSchemaPropertyRelatedBySchemaPropertyId()->getSchemaId());
      $history->setSchemaPropertyId($this->getSchemaPropertyId());
      $history->setSchemaPropertyElementId($this->getId());
      $history->setRelatedSchemaPropertyId($this->getRelatedSchemaPropertyId());
      $history->setObject($this->getObject());
      $history->setLanguage($this->getLanguage());
      $history->setStatusId($this->getStatusId());
      $history->setCreatedUserId($this->getUpdatedUserId());
      $history->setCreatedAt($this->getUpdatedAt());
      if (!empty($this->importId))
      {
        $history->setImportId($this->importId);
      }

      $history->save($con);

      if (!$reciprocal)
      {
        $this->updateReciprocal($action, $con);
      }

    return $affectedRows;
    }
    return false;
  }

  /**
   * Gets the language
   *
   * @param string $culture
   *
   * @return string The formatted language
   */
  public function getFormatLanguage($culture = null)
  {
    return format_language(parent::getLanguage(), $culture);

  } // getLanguage

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    return $this->getUserRelatedByCreatedUserId();

  } // getCreatedUser

  /**
  * Gets the updated_by_user
  *
  * @return User
  */
  public function getUpdatedUser()
  {
    return $this->getUserRelatedByUpdatedUserId();

  } // getUpdatedUser

  /**
   * Get the related class id.
   *
   * @return     int
   */
  public function getRelatedSchemaClassId()
  {

    return $this->related_schema_property_id;
  }

  /**
   * updates/creates/deletes the reciprocal property
   *
   * @param  string     $action
   * @param  Connection $con
   *
   * @throws Exception
   * @throws PropelException
   */
  public function updateReciprocal($action, $con = null)
  {
    $relatedPropertyId = $this->getRelatedSchemaPropertyId();
    if (!$relatedPropertyId) {
      return;
    }

    $recipProfilePropertyId = $this->getProfileProperty()->getInverseProfilePropertyId();
    if (!$recipProfilePropertyId) {
      return;
    }

    $schemaPropertyID = $this->getSchemaPropertyId();

    //does the user have editorial rights to the reciprocal...
    //get the schema_id of the reciprocal property
    /** @var $user myUser */
    $user       = sfContext::getInstance()->getUser();
    $userId     = $user->getSubscriberId();
    $permission = FALSE;

    $c = new Criteria();
    $c->add(SchemaPropertyPeer::ID, $relatedPropertyId);
    $property = SchemaPropertyPeer::doSelectOne($c);
    if ($property) {
      $schemaId = $property->getSchemaId();

      //does this user have the proper credentials?
      $permission = $user->hasObjectCredential(
        $schemaId,
        'schema',
        array(
          0 => array(
            0 => 'administrator',
            1 => 'schemamaintainer',
            2 => 'schemaadmin',
          )
        )
      );
    }

    if (!$permission) {
      return;
    }

    $c = new Criteria();
    $c->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $relatedPropertyId);
    $c->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $recipProfilePropertyId);
    $c->add(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID,$schemaPropertyID);

    $recipElement = SchemaPropertyElementPeer::doSelectOne($c, $con);

    $recipSchemaProperty = SchemaPropertyPeer::retrieveByPK($relatedPropertyId, $con);

    $recipProfileProperty = ProfilePropertyPeer::retrieveByPK($recipProfilePropertyId, $con);
    $statusId = $this->getStatusId();

    if ($recipProfileProperty)
    {
      $recipField = $recipProfileProperty->getName();
    }

    //if action == deleted then
    if ('deleted' == $action && $recipElement)
    {
      //delete the reciprocal
      $recipElement->delete($con);
      return;
    }

    //if action == added, and reciprocal doesn't exist
    if ('added' == $action && !$recipElement)
    {
      //add the reciprocal
      $recipElement = SchemaPropertyElementPeer::createElement($recipSchemaProperty, $userId, $recipProfilePropertyId, $statusId);
    }

    //if action == updated
    if ('updated' == $action)
    {
      //check to see if there's a reciprocal
      if (!$recipElement)
      {
        //create a new one
        $recipElement = SchemaPropertyElementPeer::createElement($recipSchemaProperty, $userId, $recipProfilePropertyId, $statusId);
      }
    }

    if ($recipElement)
    {
      $recipElement->setUpdatedUserId($userId);
      $recipElement->setRelatedSchemaPropertyId($schemaPropertyID);
      $recipElement->setObject('');
      $recipElement->save($con, true);
    }

    return;
  }

}
