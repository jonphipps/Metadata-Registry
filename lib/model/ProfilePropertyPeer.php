<?php

/**
 * Subclass for performing query and update operations on the 'profile_property' table.
 *
 *
 *
 * @package lib.model
 */
class ProfilePropertyPeer extends BaseProfilePropertyPeer
{
  /** the value for the altLabel ID  */
  const LABEL_ALT_ID = 1;

  /** the value for the hiddenLabel ID  */
  const LABEL_HIDDEN_ID = 9;

  /** the value for the prefLabel ID  */
  const LABEL_PREF_ID = 19;

  /** the value for the label ID  */
  const LABEL_ID = 27;

  /**
   * description
   *
   * @return ProfileProperty[]
   */
  public static function getResourceProperties()
  {
    $c = new Criteria();
    $c->add(self::IS_OBJECT_PROP, 1);
    $c->add(self::PROFILE_ID, 2);
    $c->clearSelectColumns()->addSelectColumn(self::SKOS_ID);
    $rs = self::doSelectRS($c);
    while($rs->next())
    {
      $results[] = $rs->getInt(1);
    }

    return $results;
  }

  /**
   * description
   *
   * @return ProfileProperty[]
   */
  public static function getPicklist()
  {
    $c = new Criteria();
    $c->add(self::IS_IN_PICKLIST,true);
    $c->add(self::PROFILE_ID, 2);
    $c->addAscendingOrderByColumn(self::PICKLIST_ORDER);
    $results = self::doSelect($c);

    //create appearance of tree
    /** @var $result ProfileProperty **/
    foreach ($results as $result)
    {
      $result->setId($result->getSkosId());
      if ($result->getSkosParentId())
      {
        $result->setLabel('&nbsp;&nbsp;&nbsp;' . $result->getLabel());
      }
    }

    return $results;
  }

  /**
   * description
   *
   * @return ProfileProperty[]
   */
  public static function getPropertyNames()
  {
    $results = false;
    $c = new Criteria();
    $c->clearSelectColumns()->addSelectColumn(self::SKOS_ID);
    $c->add(self::PROFILE_ID, 2);
    $c->addSelectColumn(self::NAME);
    $rs = self::doSelectRS($c);
    while($rs->next())
    {
      $results[$rs->getString(2)] = $rs->getInt(1);
    }

    return $results;
  }




  /**
  * gets repeatable or unused profile properties for a resource property element
  *
  * @return array
  * @param  criteria $criteria
  */
  public static function getProfilePropertiesForCreate($criteria = null)
  {
    if ($criteria === null) {
      $criteria = new Criteria();
    }
    elseif ($criteria instanceof Criteria)
    {
      $criteria = clone $criteria;
    }

    //get the current property ID
    //create should always have a property id
    $propertyId = sfContext::getInstance()->getRequest()->getParameter('schema_property_id');

    //get the current property
    if ($propertyId)
    {
      $schemaProperty = SchemaPropertyPeer::retrieveByPK($propertyId);
      if ('class' == $schemaProperty->getType() || 'subclass' == $schemaProperty->getType())
      {
        $criteria->add(ProfilePropertyPeer::IS_IN_CLASS_PICKLIST,1);
      }
      else
      {
        $criteria->add(ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST,1);
      }
    }

    //properties for the metadata registry schema are currently related to profile '1'
    $criteria->add(ProfilePropertyPeer::PROFILE_ID,1);
    $criteria->add(ProfilePropertyPeer::IS_IN_PICKLIST,1);
    $criteria->addAscendingOrderByColumn(ProfilePropertyPeer::URI);

    //get the list of all properties for this profile/namespace
    //at some point this should look at the property or schema namespace
    $profileProperties = self::doSelect($criteria);
    $propertyList = array();
    $pickList = array();

    foreach ($profileProperties as $key => $property)
    {
      $propertyList[$property->getId()] = $property;
      $pickList[$property->getId()] = $property->getLabel();
    }

    //get the property elements already in use for this property
    $c = new Criteria();
    $c->add(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID,$propertyId);
    $c->add(SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY,true);
    $elements = SchemaPropertyElementPeer::doSelect($c);

    foreach ($elements as $key => $element)
    {
      $propertyId = $element->getProfilePropertyId();
      //if the property is in the list and not repeatable
      /** @var ProfileProperty **/
      if (isset($propertyList[$propertyId]) && $propertyList[$propertyId]->getIsSingleton())
      {
        //remove it from the list of all properties
        unset($pickList[$propertyId]);
        unset($propertyList[$propertyId]);
      }
    }

    return $propertyList; //whatever remains in the list
  }

}
