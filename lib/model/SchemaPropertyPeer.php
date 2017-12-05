<?php

/**
 * Subclass for performing query and update operations on the 'reg_schema_property' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyPeer extends BaseSchemaPropertyPeer
{
    /**
     * returns properties for the current schema
     *
     * @return SchemaProperty[]
     * @throws PropelException
     */
  public static function getPropertiesByCurrentSchemaID()
  {
    $schema = self::getSchema();
    $c = new Criteria();
    $c->add(self::SCHEMA_ID, $schema->getId());
    $c->add(self::TYPE,'property');
    $c->addOr(self::TYPE,'subproperty');
    $c->addAscendingOrderByColumn(self::LABEL);
    $properties = $schema->getSchemaPropertys($c);

    $request = sfContext::getInstance()->getRequest();
    $currentPropertyId = $request->getParameter('id');
    if ('schemaprop' === $request->getParameter('module') && "edit" === $request->getParameter('action'))
    {
      foreach ($properties as $id => $property)
      {
        if ($property->getId() == $currentPropertyId)
        {
          unset($properties[$id]);
          break;
        }
      }
    }
    return $properties;
  }

    /**
     * returns classes for the current schema
     *
     * @return SchemaProperty[]
     * @throws PropelException
     */
  public static function getClassesByCurrentSchemaID()
  {
    $schema = self::getSchema();
    $c = new Criteria();
    $c->add(self::SCHEMA_ID, $schema->getId());
    $c->add(self::TYPE,'class');
    $c->addOr(self::TYPE,'subclass');
    $c->addAscendingOrderByColumn(self::LABEL);
    $classes = self::doSelect($c);

    $request = sfContext::getInstance()->getRequest();
    $currentPropertyId = $request->getParameter('id');
    if ('schemaprop' === $request->getParameter('module') && 'edit' === $request->getParameter('action')) {
      /** @var $property SchemaProperty */
      foreach ($classes as $id => $property) {
        if ($property->getId() == $currentPropertyId) {
          unset($classes[$id]);
          break;
        }
      }
    }
    return $classes;
  }

  /**
   * @return array
   */
  public static function getClassesForCurrentUser() {
    return self::getElementsForCurrentUser("class");
  }
  /**
   * @return array
   */
  public static function getPropertiesForCurrentUser() {
    return self::getElementsForCurrentUser("property");
  }
  /**
   * @param string $type
   *
   * @return array
   */
  public static function getElementsForCurrentUser($type) {
    $userId = sfContext::getInstance()->getUser()->getSubscriberId();
    if (!$userId) {
      //can't do a proper filter, but this is unlikely
      return FALSE;
    }
    $c = new Criteria();
    $c->addJoin(SchemaPropertyPeer::SCHEMA_ID, SchemaHasUserPeer::SCHEMA_ID)
      ->addJoin(SchemaPeer::ID, SchemaHasUserPeer::SCHEMA_ID);
    $c->add(SchemaHasUserPeer::USER_ID, $userId);
    //todo: remove the 'subs' when we don't have the option in the db
    if ("class" == strtolower($type)) {
      $c->add(self::TYPE, 'class');
      $c->addOr(self::TYPE, 'subclass');
    }
    else {
      $c->add(self::TYPE, 'property');
      $c->addOr(self::TYPE, 'subproperty');
    }
    $request           = sfContext::getInstance()->getRequest();
    $currentPropertyId = $request->getParameter('id');
    if ($currentPropertyId && "schemaprop" == $request->getParameter('module') && "edit" == $request->getParameter('action')) {
      $c->add(SchemaPropertyPeer::ID, $currentPropertyId, Criteria::NOT_EQUAL);
    }
    $c->clearSelectColumns()
      ->addSelectColumn(SchemaPropertyPeer::ID)
      ->addSelectColumn(SchemaPeer::NAME)
      ->addSelectColumn(SchemaPropertyPeer::LABEL)
      ->addSelectColumn(SchemaPropertyPeer::URI);
    $c->addAscendingOrderByColumn(SchemaPeer::NAME)
      ->addAscendingOrderByColumn(SchemaPropertyPeer::LABEL);
    /** @var $rs MySQLResultSet */
    $rs = self::doSelectRS($c);
    $results   = array();
    /** @var $rs MySQLResultSet */
    while ($rs->next()) {
      $results[$rs->getString(2) ][ $rs->getInt(1) ] = $rs->getString(3) . " -- " . $rs->getString(4);
    }
    return $results;
  }
  /**
   * @param SchemaProperty $property
   * @param string                            $fieldName
   * @param string                            $object
   * @param int                               $objectId if the object has a related Id
   * @param int                               $userId
   * @param array                             $fieldIds
   * @param int                               $statusId
   * @param Connection                        $con
   *
   * @throws Exception
   * @throws PropelException
   * @return bool
   */
  public static function updateRelatedElements($property, $fieldName, $object, $objectId, $userId, $fieldIds, $statusId, $con) {
    if (isset($fieldIds[ $fieldName ])) {
      $profileId = $fieldIds[ $fieldName ]['id'];
    }
    else {
      return false;
    }
    $language =  $fieldIds[ $fieldName ]['hasLang'] ? $property->getLanguage() : null ;
    $element   = SchemaPropertyElementPeer::lookupDetailElement($property->getId(), $profileId, $language);
    if ($element) {
      //no matter what we do, it's not generated any more
      $element->setIsGenerated(false);
      //did we make it null?
      if (0 === strlen(trim($object))) {
        //we have to make sure that it's not a subclass or subproperty
        if (('is_subproperty_of' == $fieldName || 'is_subclass_of' == $fieldName)
            && $property->getParentUri()
        ) {
          //there's a uri but it doesn't match anything registered
          //so we have to delete just the reciprocal
          $element->updateReciprocal('deleted', $userId, $property->getSchemaId(), $con);
        }
        else {
          //delete the element
          $element->delete($con);
        }
      }
      else {
        //modify it
        $element->setObject($object);
        $element->setRelatedSchemaPropertyId($objectId);
        $element->setUpdatedUserId($userId);
        $element->save();
      }
    }
    elseif ($profileId && $object) {
      //create one
      $element = SchemaPropertyElementPeer::createElement($property, $userId, $profileId, $statusId, $language, false);
      $element->setObject($object);
      $element->setRelatedSchemaPropertyId($objectId);
      $element->setIsSchemaProperty(TRUE);
      $element->save();
    }
    return true;
  }
  /**
   * description
   *
   * @param string $uri
     *
   * @return SchemaProperty
   */
  public static function  retrieveByUri($uri)
  {
    $criteria = new Criteria();
    $criteria->add(self::URI, $uri);

    return self::doSelectOne($criteria);

  }

  /**
   * sets the criteria and returns the few columns needed for schema property search results
   *
   * @param Criteria $c The Criteria object used to build the SELECT statement.
   * @param Connection $con
     *
     * @return array Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *     rethrown wrapped into a PropelException.
   */
   public static function doSelectSearchResults(Criteria $c, $con = null)
  {
    $results = self::doSelectJoinSchema($c);

    return $results;
   }

  /**
   *
   * @return Schema
   */
  private static function getSchema()
  {
    $currentPropertyId = sfContext::getInstance()->getRequest()->getParameter('schema_property_id', '');
    if ($currentPropertyId) {
      $schema = SchemaPropertyPeer::retrieveByPK($currentPropertyId)->getSchema();
    } else {
      $schema = sfContext::getInstance()->getUser()->getAttribute('schema');
    }
    if ( ! $schema) {
      $id = sfContext::getInstance()->getRequest()->getParameter('id', '');
      if ($id) {
        if ("schemapropel" == sfContext::getInstance()->getModuleName()) {
          $schema =
                SchemaPropertyElementPeer::retrieveByPK($id)->getSchemaPropertyRelatedBySchemaPropertyId()->getSchema();
        } else {
          $schema = self::retrieveByPK($id)->getSchema();
        }
      }
    }

    return $schema;
  }
  /**
   * @param $schemaId
   *
   * @return SchemaProperty[]
   */
  public static function getElementsForSchema($schemaId) {
    $c = new Criteria();
    $c->add(self::SCHEMA_ID, $schemaId);
    $elements = self::doSelect($c);
    return $elements;
  }

}
