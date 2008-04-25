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

}

sfPropelBehavior::add('SchemaPropertyElement', array('paranoid'));
