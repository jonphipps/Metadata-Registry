<?php

  /**
   * Subclass for performing query and update operations on the 'reg_schema_property_element' table.
   *
   *
   *
   * @package lib.model
   */
  class SchemaPropertyElementPeer extends BaseSchemaPropertyElementPeer {
    /**
     * create and add an individual element
     *
     * @param  SchemaProperty $schema_property
     * @param                 $userId
     * @param                 $fieldId
     *
     * @return \SchemaPropertyElement
     */
    public static function createElement(SchemaProperty $schema_property, $userId, $fieldId) {
      $element = new SchemaPropertyElement();
      $element->setCreatedUserId($userId);
      $element->setUpdatedUserId($userId);
      $element->setSchemaPropertyId($schema_property->getId());
      $element->setLanguage($schema_property->getCurrentSchemaPropertyI18n()->getCulture());
      $element->setStatusId($schema_property->getStatusId());
      $element->setProfilePropertyId($fieldId);

      return $element;
      //self::updateElement($schema_property, $element, $userId, $field, $con, $isSchemaProperty);

    } // createElement

    /**
     * description
     *
     * @param integer $schemaPropertyId [Optional}
     * @param integer $profilePropertyId
     * @param string  $value
     * @param string  $language         (optional)
     *
     * @return SchemaPropertyElement
     */
    public static function lookupElement($schemaPropertyId = NULL, $profilePropertyId, $value, $language = NULL) {
      $c = new Criteria();
      $c->add(self::PROFILE_PROPERTY_ID, $profilePropertyId);
      $c->add(self::OBJECT, $value);
      //only add the schema property id if we know what the schema property is
      if ($schemaPropertyId) {
        $c->add(self::SCHEMA_PROPERTY_ID, $schemaPropertyId);
      }
      if ($language) {
        $c->add(self::LANGUAGE, $language);
      }

      $results = self::doSelectOne($c);

      return $results;
    }

    /**
     * description
     *
     * @param integer $schemaPropertyId
     * @param integer $profilePropertyId
     * @param string  $language (optional)
     *
     * @return SchemaPropertyElement
     */
    public static function lookupDetailElement($schemaPropertyId, $profilePropertyId, $language = NULL) {
      $c = new Criteria();
      $c->add(self::PROFILE_PROPERTY_ID, $profilePropertyId);
      $c->add(self::IS_SCHEMA_PROPERTY, TRUE);
      $c->add(self::SCHEMA_PROPERTY_ID, $schemaPropertyId);
      if ($language) {
        $c->add(self::LANGUAGE, $language);
      }

      $results = self::doSelectOne($c);

      return $results;
    }
  }

  sfPropelBehavior::add('SchemaPropertyElement', array('paranoid'));
