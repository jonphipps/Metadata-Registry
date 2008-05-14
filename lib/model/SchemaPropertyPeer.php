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
    $properties = $schema->getSchemaPropertys();

    $request = sfContext::getInstance()->getRequest();
    $currentPropertyId = $request->getParameter('id');
    if ("schemaprop" == $request->getParameter('module') && "edit" == $request->getParameter('action'))
    {
      foreach ($properties as $id => $property)
      {
        if ($property->getId() == $currentPropertyId)
        {
          unset($properties[$id]);
          break;
        }
      }
    }
    return $properties;
  }

}
