<?php

/**
 * Subclass for performing query and update operations on the 'reg_schema_property_element' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPropertyElementPeer extends BaseSchemaPropertyElementPeer
{
  /**
   * create and add an individual element
   *
   * @param  SchemaProperty $schema_property
   * @param  int            $userId
   * @param  int            $fieldId
   *
   * @return \SchemaPropertyElement
   */
  public static function createElement(SchemaProperty $schema_property, $userId, $fieldId)
  {
    $element = new SchemaPropertyElement();
    $element->setCreatedUserId($userId);
    $element->setUpdatedUserId($userId);
    $element->setSchemaPropertyId($schema_property->getId());
    $element->setLanguage($schema_property->getLanguage());
    $element->setStatusId($schema_property->getStatusId());
    $element->setProfilePropertyId($fieldId);

    return $element;

    //self::updateElement($schema_property, $element, $userId, $field, $con, $isSchemaProperty);

  } // createElement

  /**
   * description
   *
   * @return SchemaPropertyElement
   *
   * @param $propertyId
   * @param $elementId
   * @param $object
   *
   * @internal param \var_type $var
   */
  public static function lookupElement($propertyId, $elementId, $object)
  {
    $c = new Criteria();
    $c->add(self::SCHEMA_PROPERTY_ID, $propertyId);
    $c->add(self::PROFILE_PROPERTY_ID, $elementId);
    $c->add(self::OBJECT,$object);

    $results = self::doSelectOne($c);

    return $results;
  }

}

sfPropelBehavior::add('SchemaPropertyElement', array('paranoid'));
