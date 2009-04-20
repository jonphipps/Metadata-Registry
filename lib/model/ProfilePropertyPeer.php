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
    //properties for the metadata registry schema are currently related to profile '1'
    $criteria->add(ProfilePropertyPeer::PROFILE_ID,1);
    $criteria->addAscendingOrderByColumn(ProfilePropertyPeer::PICKLIST_ORDER);

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


    //get the current property ID
    //create should always have a property id
    $propertyId = sfContext::getInstance()->getRequest()->getParameter('schema_property_id');

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
      if ($propertyList[$propertyId]->getIsSingleton())
      {
        //remove it from the list of all properties
        unset($pickList[$propertyId]);
        unset($propertyList[$propertyId]);
      }
    }

    return $propertyList; //whatever remains in the list
  }

}
