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
   *
   * @param int $propertyId
   * @param int $profilePropertyId
   * @param string $object
   * @param null $language
   *
   * @return SchemaPropertyElement
   */
  public static function lookupElement($propertyId, $profilePropertyId, $object, $language = null)
  {
    $c = new Criteria();
    $c->add(self::SCHEMA_PROPERTY_ID, $propertyId);
    $c->add(self::PROFILE_PROPERTY_ID, $profilePropertyId);
    $c->add(self::OBJECT,$object);

    if ($language)
    {
      $c->add(self::LANGUAGE, $language);
    }

    $results = self::doSelectOne($c);

    return $results;
  }

  /**
   * @param $propertyId
   * @return SchemaPropertyElement[]
   */
  public static function getNonSchemaPropertyElements($propertyId) {
    $c = new Criteria();
    $c->add(self::SCHEMA_PROPERTY_ID, $propertyId);
    $c->add(self::IS_SCHEMA_PROPERTY, false);

    $results = self::doSelect($c);

    return $results;
  }

}

sfPropelBehavior::add('SchemaPropertyElement', array('paranoid'));
