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
  /** THIS SHOULD NOT BE HARDWIRED LIKE THIS */
  const HAS_SUBPROPERTY_PROPERTY_ID = 8;

  /** THIS SHOULD NOT BE HARDWIRED LIKE THISs */
  const IS_SUBPROPERTY_OF_PROPERTY_ID = 6;

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function __toString()
  {
    return $this->getProfileProperty()->__toString();
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
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

      $history->save($con);

      if (!$reciprocal)
      {
        $this->updateReciprocal($action, $con);
      }
    }


    return $affectedRows;
  }

  /**
  * Gets the language
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
  * updates/creates/deletes the reciprocal property
  *
  * @param  SchemaPropertyElement $element
  * @param  string $action
  * @param  Connection $con
  */
  public function updateReciprocal($action, $con = null)
  {
    /**
    * @todo $recipProfilePropertyId should not be hard-wired, Get from the DB when retrieving field name
    **/
    $relatedPropertyId = $this->getRelatedSchemaPropertyId();

    if (!$relatedPropertyId)
    {
      return;
    }

    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    $schemaPropertyID = $this->getSchemaPropertyId();

    if (self::HAS_SUBPROPERTY_PROPERTY_ID == $this->getProfilePropertyId())
    {
      $recipProfilePropertyId = self::IS_SUBPROPERTY_OF_PROPERTY_ID;
    }
    else
    {
      $recipProfilePropertyId = self::HAS_SUBPROPERTY_PROPERTY_ID;
    }
    $c = new Criteria();
    $c->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $relatedPropertyId);
    $c->add(SchemaPropertyElementPeer::PROFILE_PROPERTY_ID, $recipProfilePropertyId);
    $c->add(SchemaPropertyElementPeer::RELATED_SCHEMA_PROPERTY_ID,$schemaPropertyID);

    $recipElement = SchemaPropertyElementPeer::doSelectOne($c, $con);

    $recipSchemaProperty = SchemaPropertyPeer::retrieveByPK($relatedPropertyId, $con);

    $recipProfileProperty = ProfilePropertyPeer::retrieveByPK($recipProfilePropertyId, $con);

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
      $recipElement = SchemaPropertyElementPeer::createElement($recipSchemaProperty, $userId, $recipProfilePropertyId);
    }

    //if action == updated
    if ('updated' == $action)
    {
      //check to see if there's a reciprocal
      if (!$recipElement)
      {
        //create a new one
        $recipElement = SchemaPropertyElementPeer::createElement($recipSchemaProperty, $userId, $recipProfilePropertyId);
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
