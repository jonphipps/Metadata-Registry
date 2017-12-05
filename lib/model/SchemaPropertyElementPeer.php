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
     * @param  int $userId
     * @param  int $fieldId
     * @param  int $statusId
     * @param string $language
     *
     * @param bool $isGenerated
     * @return SchemaPropertyElement
     */
    public static function createElement(
        $schema_property,
        $userId,
        $fieldId,
        $statusId,
        $language = null,
        $isGenerated = false
    )
    {
        $element = new SchemaPropertyElement();
        $element->setCreatedUserId($userId);
        $element->setUpdatedUserId($userId);
        $element->setSchemaPropertyId($schema_property->getId());
        $element->setLanguage($language);
        $element->setStatusId($statusId);
        $element->setProfilePropertyId($fieldId);
        $element->setIsGenerated($isGenerated);

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
     * @return SchemaPropertyElement[]
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

    /**
     * @param SchemaProperty $schema_property
     * @param int            $userId
     * @param Connection     $con
     *
     * @returns array Affected statements
     */
    public static function updateElementsFromForm(SchemaProperty $schema_property, $userId, $con = null)
    {
        $language = myActionTools::getEditLanguage();

        $fields = Schema::getProfileFields();
        //add parent_uri to fields
        $fields[] = "parent_uri";
        $affected = [];

        //iterate through the fields
        foreach ($fields as $key => $value) {

            //lookup each field in the array
            //if it's a match compare the values
            if ($key) {
                //if the new value is empty and the old value is not, delete the old value
                if ($key) {
                } //if the values are different update the element
                else if ($key) {
                }
            } //if there's no match then create a new element
            else {
            }
        }

        return $affected;
    }

    /**
     * @param $propertyId
     * @return SchemaPropertyElement[]
     */
    public static function getNonSchemaPropertyElements( $propertyId )
    {
        $c = new Criteria();
        $c->add( self::SCHEMA_PROPERTY_ID, $propertyId );
        $c->add( self::IS_SCHEMA_PROPERTY, Criteria::ISNULL );

        $results = self::doSelect( $c );

        return $results;
    }

    /**
     * @param int $schemaId
     * @return array
     */
    public static function getNamespaceList( $schemaId )
    {
        $namespaces = array();

        $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn(SchemaPropertyElementPeer::OBJECT);
        $c->add(SchemaPropertyElementPeer::OBJECT,"http%", Criteria::LIKE);
        $c->add( SchemaPropertyPeer::SCHEMA_ID, $schemaId );
        $c->addJoin(SchemaPropertyElementPeer::SCHEMA_PROPERTY_ID,SchemaPropertyPeer::ID);
        $result = self::doSelectRS($c);
        self::getNamespaceUris( $result, 'getObject', $namespaces );

        $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn(SchemaPropertyPeer::URI);
        $c->add( SchemaPropertyPeer::SCHEMA_ID, $schemaId );
        $result = SchemaPropertyPeer::doSelectRS( $c );
        self::getNamespaceUris( $result, 'getUri', $namespaces );

        return $namespaces;
    }

    /**
     * @param $queryResult
     * @param $method
     * @param $namespaces
     * @return mixed
     */
    protected static function getNamespaceUris( $queryResult, $method, &$namespaces )
    {
        /** @var \SchemaProperty $value */
        foreach ( $queryResult as $value )
        {
            $match = preg_match(
              '/\b(?<protocol>https?|ftp):\/\/(?<domain>[-A-Z0-9.]+)(?<path>\/[-A-Z0-9+&@#\/%=~_|!:,.;]*[\/|#])(?<file>[-A-Z0-9+&@#\/%=~_|!:,.;]*)?(?<parameters>\?[A-Z0-9+&@#\/%=~_|!:,.;]*)?/i',
              $value[0],
              $matches
            );
            if ( $match )
            {
                $index              = $matches['protocol'] . "://" . $matches['domain'] . $matches['path'];
                $namespaces[$index] = $index;
            }
        }

        return $namespaces;
    }

    /**
     * @param Criteria $c
     * @param null     $con
     *
     * @return array
     * @throws PropelException
     */
    public static function doSelectJoinProfilePropertySortByProfileProperty(Criteria $c, $con = null)
    {
        $c = clone $c;

        $c->addAscendingOrderByColumn(ProfilePropertyPeer::LABEL);
        $c->addAscendingOrderByColumn(self::LANGUAGE);

        return self::doSelectJoinProfileProperty($c, $con);
    }
}

sfPropelBehavior::add( 'SchemaPropertyElement', array( 'paranoid' ) );
