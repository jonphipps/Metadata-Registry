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
     *
     * @param  \Criteria $criteria
     */
    public static function getProfilePropertiesForCreate($criteria = null)
    {
        if ($criteria === null) {
            $criteria = new Criteria();
        } elseif ($criteria instanceof \Criteria) {
            $criteria = clone $criteria;
        }

        //get the current property ID
        //create should always have a property id
        $propertyId = \sfContext::getInstance()->getRequest()->getParameter('schema_property_id');

        //get the current property
        if ($propertyId) {
            $schemaProperty = \SchemaPropertyPeer::retrieveByPK($propertyId);
            if ('class' == $schemaProperty->getType() || 'subclass' == $schemaProperty->getType()) {
                $criteria->add(\ProfilePropertyPeer::IS_IN_CLASS_PICKLIST, 1);
                $criteria->add(\ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST, 1);
                if ('class' == $schemaProperty->getType()) {
                    $criteria->add(\ProfilePropertyPeer::NAME, 'isSubclassOf', \Criteria::NOT_EQUAL);
                }
            } else {
                $criteria->add(\ProfilePropertyPeer::IS_IN_PROPERTY_PICKLIST, 1);
                if ('property' == $schemaProperty->getType()) {
                    $criteria->add(\ProfilePropertyPeer::NAME, 'isSubpropertyOf', \Criteria::NOT_EQUAL);
                }
            }
        }

        //properties for the metadata registry schema are currently related to profile '1'
        $criteria->add(\ProfilePropertyPeer::PROFILE_ID, 1);
        $criteria->add(\ProfilePropertyPeer::IS_IN_PICKLIST, 1);
        $criteria->addAscendingOrderByColumn(\ProfilePropertyPeer::URI);

        //get the list of all properties for this profile/namespace
        //at some point this should look at the property or schema namespace
        $profileProperties = self::doSelect($criteria);
        $propertyList      = array();
        $pickList          = array();

        foreach ($profileProperties as $key => $property) {
            $propertyList[$property->getId()] = $property;
            $pickList[$property->getId()]     = $property->getLabel();
        }

        //get the property elements already in use for this property
        $c = new Criteria();
        $c->add(\SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID, $propertyId);
        $c->add(\SchemaPropertyElementPeer::IS_SCHEMA_PROPERTY, true);
        $elements = \SchemaPropertyElementPeer::doSelect($c);

        foreach ($elements as $key => $element) {
            $propertyId = $element->getProfilePropertyId();
            //if the property is in the list and not repeatable
            /** @var ProfileProperty * */
            if (isset($propertyList[$propertyId]) && $propertyList[$propertyId]->getIsSingleton()) {
                //remove it from the list of all properties
                unset($pickList[$propertyId]);
                unset($propertyList[$propertyId]);
            }
        }

        return $propertyList; //whatever remains in the list
    }
}
