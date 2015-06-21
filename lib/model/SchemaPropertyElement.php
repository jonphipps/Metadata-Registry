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
  public $doReciprocal = true;

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
   *
   * @throws Exception
   * @throws PropelException
   */
  public function save($con = null)
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
      $doHistory = true;

      if (count($this->modifiedColumns) == 1
          and $this->modifiedColumns[0] == 'reg_schema_property_element.RELATED_SCHEMA_PROPERTY_ID') {
        $doHistory = false;
      }
      //continue with save
      $affectedRows = parent::save($con);

      $userId = $this->getUpdatedUserId();

      //update the schema
      $schema = $this->getSchemaPropertyRelatedBySchemaPropertyId();
      $schemaId = $schema->getSchemaId();
      $schema->setUpdatedAt($this->getUpdatedAt());
      $schema->setUpdatedUserId($userId);
      $schema->save();

      if ($doHistory) { //do the history
        $history = new SchemaPropertyElementHistory();

        if ($action == 'updated' && $this->getDeletedAt()) {
          $action = 'deleted';
        }

        if ($this->getIsGenerated()) {
          $action = 'generated';
        }

        $history->setAction($action);
        $history->setProfilePropertyId($this->getProfilePropertyId());
        $history->setSchemaId($schemaId);
        $history->setSchemaPropertyId($this->getSchemaPropertyId());
        $history->setSchemaPropertyElementId($this->getId());
        $history->setRelatedSchemaPropertyId($this->getRelatedSchemaPropertyId());
        $history->setObject($this->getObject());
        $history->setLanguage($this->getLanguage());
        $history->setStatusId($this->getStatusId());
        $history->setCreatedUserId($userId);
        $history->setCreatedAt($this->getUpdatedAt());
        if ( ! empty($this->importId)) {
          $history->setImportId($this->importId);
        }

        $history->save($con);
      }

      if (!$this->doReciprocal)
      {
        $this->updateReciprocal($action, $userId, $schemaId, $con);
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
   * @param  int        $userId
   * @param  int        $schemaId
   * @param  Connection $con
   *
   * @throws \PropelException
   */
  public function updateReciprocal($action, $userId, $schemaId, $con = null)
  {
    $inverseProfilePropertyId = $this->getProfileProperty()->getInverseProfilePropertyId();
    if (empty($inverseProfilePropertyId) and $this->getProfileProperty()->getIsReciprocal()) {
      $inverseProfilePropertyId = $this->getProfileProperty()->getId();
    }
    if ( ! $inverseProfilePropertyId) {
      //there's no reciprocal or inverse to process
      return;
    }

    $relatedPropertyId = $this->getRelatedSchemaPropertyId();
    if (!$relatedPropertyId) {
      $relatedProperty = SchemaPropertyPeer::retrieveByUri($this->getObject());
      if (!$relatedProperty) {
        //there's no related property in the registry
        return;
      } else {
        $relatedPropertyId = $relatedProperty->getId();
        $this->setRelatedSchemaPropertyId($relatedPropertyId);
        $this->save();
      }
    }

    $schemaPropertyID = $this->getSchemaPropertyId();
    $property = $this->getSchemaPropertyRelatedBySchemaPropertyId();

    //does the user have editorial rights to the reciprocal...
    $permission = false;
    //get the maintainers of the reciprocal property
    $maintainers = $property->getSchema()->getMaintainerIds();
    foreach ($maintainers as $maintainerId) {
      if ($userId == $maintainerId) {
        $permission = true;
        break;
      }
    }

    if ( false === $permission) {
      return;
    }

    $c = new Criteria();
    $c->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $relatedPropertyId);
    $c->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $inverseProfilePropertyId);
    $c->add(SchemaPropertyElementPeer::OBJECT,$property->getUri());

    $recipElement = SchemaPropertyElementPeer::doSelectOne($c, $con);

    $recipSchemaProperty = SchemaPropertyPeer::retrieveByPK($relatedPropertyId, $con);

    $recipProfileProperty = ProfilePropertyPeer::retrieveByPK($inverseProfilePropertyId, $con);
    $statusId = $this->getStatusId();
    $language = '';

    if ($recipProfileProperty)
    {
      $recipField = $recipProfileProperty->getName();
      if ($recipProfileProperty->getHasLanguage()) {
        $language = $this->getLanguage();
      }
    }

    //if action == deleted then
    if ('deleted' == $action && $recipElement)
    {
      //delete the reciprocal
      $recipElement->delete($con);
      return;
    }

    //undelete the element if it's deleted and we get this far
    if (isset($recipElement)) {
      $recipElement->setDeletedAt(null);
    }

    //if action == added, and reciprocal doesn't exist
    if ('added' == $action && !$recipElement)
    {
      //add the reciprocal
      $recipElement = SchemaPropertyElementPeer::createElement($recipSchemaProperty, $userId, $inverseProfilePropertyId, $statusId, $language);
    }

    //if action == updated
    if ('updated' == $action)
    {
      //check to see if there's a reciprocal
      if (!$recipElement)
      {
        //create a new one
        $recipElement = SchemaPropertyElementPeer::createElement($recipSchemaProperty, $userId, $inverseProfilePropertyId, $statusId, $language);
      }
    }

    if ($recipElement)
    {
      if (isset($this->importId))
      {
        $recipElement->importId = $this->importId;
      }
      $recipElement->setUpdatedUserId($userId);
      $recipElement->setRelatedSchemaPropertyId($schemaPropertyID);
      $recipElement->setObject($this->getSchemaPropertyRelatedBySchemaPropertyId()->getUri());
      $recipElement->save($con);
    }

    return;
  }

}
