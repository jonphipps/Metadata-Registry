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
     * @param  int $userId
     * @param  int $fieldId
     *
     * @return \SchemaPropertyElement
     */
    public static function createElement( SchemaProperty $schema_property, $userId, $fieldId )
    {
        $element = new SchemaPropertyElement();
        $element->setCreatedUserId( $userId );
        $element->setUpdatedUserId( $userId );
        $element->setSchemaPropertyId( $schema_property->getId() );
        $element->setLanguage( $schema_property->getLanguage() );
        $element->setStatusId( $schema_property->getStatusId() );
        $element->setProfilePropertyId( $fieldId );

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
     * @param bool $excludeSchema
     * @return SchemaPropertyElement
     * @internal param bool $isSchemaProperty
     */
    public static function lookupElement( $propertyId, $profilePropertyId, $object = null, $language = null, $excludeSchema = false )
    {
        $c = new Criteria();
        $c->add( self::SCHEMA_PROPERTY_ID, $propertyId );
        $c->add( self::PROFILE_PROPERTY_ID, $profilePropertyId );
        if ( ! empty( $object ) )
        {
            $c->add( self::OBJECT, $object );
        }

        if ( $language )
        {
            $c->add( self::LANGUAGE, $language );
        }

        if ( $excludeSchema )
        {
            $c->add( self::IS_SCHEMA_PROPERTY, null, Criteria::ISNULL );
        }

        $results = self::doSelect( $c );

        return $results;
    }

    /**
     * @param $propertyId
     * @return SchemaPropertyElement[]
     */
    public static function getNonSchemaPropertyElements( $propertyId )
    {
        $c = new Criteria();
        $c->add( self::SCHEMA_PROPERTY_ID, $propertyId );
        $c->add( self::IS_SCHEMA_PROPERTY, false );

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
        $c->add( SchemaPropertyPeer::SCHEMA_ID, $schemaId );
        $result = self::doSelectJoinSchemaPropertyRelatedBySchemaPropertyId( $c );
        self::getNamespaceUris( $result, 'getObject', $namespaces );

        $c = new Criteria();
        $c->add( SchemaPropertyPeer::SCHEMA_ID, $schemaId );
        $result = SchemaPropertyPeer::doSelect( $c );
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
              call_user_func( [ &$value, $method ] ),
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
}

sfPropelBehavior::add( 'SchemaPropertyElement', array( 'paranoid' ) );
