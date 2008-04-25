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
  * returns properties for the curren schema
  *
  * @return array of schema_property
  */
  public static function getPropertiesByCurrentSchemaID()
  {
    $schema = myActionTools::findCurrentSchema();
    return $schema->getSchemaPropertys();
  }

}
