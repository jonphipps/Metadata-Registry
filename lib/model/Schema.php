<?php

/**
 * Subclass for representing a row from the 'reg_schema' table.
 *
 *
 *
 * @package lib.model
 */
class Schema extends BaseSchema
{
  public function __toString()
  {
    return $this->getName();
  }

  public function save($con = null)
  {
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    if ($userId)
    {
      $this->setUpdatedUserId($userId);
      if ($this->isNew())
      {
        $this->setCreatedUserId($userId);
      }
    }

    $con = Propel::getConnection();
    try
    {
      $con->begin();

      $ret = parent::save($con);

      // update schema_has_user table
      $schemaId = $this->getId();
      $mode = sfContext::getInstance()->getRequest()->getParameter('action');
      if ($userId && $schemaId)
      {
        //see if there's already an entry in the table and if not, add it
        $criteria = new Criteria();
        $criteria->add(SchemaHasUserPeer::USER_ID, $userId);
        $SchemaHasUsersColl = $this->getSchemaHasUsers($criteria, $con);

        if (!count($SchemaHasUsersColl))
        {
          $schemaUser = new SchemaHasUser();
          $schemaUser->setSchemaId($schemaId);
          $schemaUser->setUserId($userId);
          $schemaUser->setIsRegistrarFor(true);
          $schemaUser->setIsAdminFor(true);
          $schemaUser->setIsMaintainerFor(true);
          $schemaUser->save($con);
        }

      }

      $con->commit();

      return $ret;

    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

  /**
  * Gets the created_by_user
  *
  * @return User
  */
  public function getCreatedUser()
  {
    $user = $this->getUserRelatedByCreatedUserId();
    if ($user)
    {
      return $user->getUser();
    }

  } // getCreatedUser

  /**
  * Gets the updated_by_user
  *
  * @return User
  */
  public function getUpdatedUser()
  {
    $user = $this->getUserRelatedByUpdatedUserId();
    if ($user)
    {
      return $user->getUser();
    }

  } // getUpdatedUser

  /**
  * get the schema fields array (field_id => field name)
  *
  * @return array The fields
  */
  public static function getProfileFields()
  {
    $c = new Criteria();
    $c->add(ProfilePropertyPeer::PROFILE_ID,1);
    $properties = ProfilePropertyPeer::doSelect($c);
    $fieldsNew = array();
    foreach ($properties as $property)
    {
      $fieldsNew[$property->getId()] = sfInflector::underscore($property->getName());
    }
    /**
    * @todo $fields needs to come from an application profile for schemas, or the vocabulary
    **/
    $fields = array(
    1 => 'name',
    2 => 'label',
    3 => 'definition',
    4 => 'type',
    5 => 'comment',
    6 => 'related_property',
    7 => 'note');

    return $fieldsNew;
  }

  /**
  * clears the properties
  *
  */
  public function clearProperties()
  {
    $this->collSchemaPropertys = null;
  }

  /**
  * gets just the properties, ordered by name
  *
  * @return array SchemaProperty
  */
  public function getProperties()
  {
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::TYPE,'property');
    $c->addOr(SchemaPropertyPeer::TYPE,'subproperty');
    $c->addAscendingOrderByColumn(SchemaPropertyPeer::NAME);

    return $this->getSchemaPropertysJoinStatus($c);
  }

  /**
  * gets just the classes, ordered by name
  *
  * @return array SchemaProperty
  */
  public function getClasses()
  {
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::TYPE,'class');
    $c->addOr(SchemaPropertyPeer::TYPE,'subclass');
    $c->addAscendingOrderByColumn(SchemaPropertyPeer::NAME);

    return $this->getSchemaPropertysJoinStatus($c);
  }

}
