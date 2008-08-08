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
  * returns properties for the current schema
  *
  * @return array of schema_property
  */
  public static function getPropertiesByCurrentSchemaID()
  {
    $schema = myActionTools::findCurrentSchema();
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::TYPE,'property');
    $c->addOr(SchemaPropertyPeer::TYPE,'subproperty');
    $c->addAscendingOrderByColumn(SchemaPropertyPeer::NAME);
    $properties = $schema->getSchemaPropertys($c);

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

  /**
  * returns classes for the current schema
  *
  * @return array of schema_property
  */
  public static function getClassesByCurrentSchemaID()
  {
    $schema = myActionTools::findCurrentSchema();
    $c = new Criteria();
    $c->add(SchemaPropertyPeer::TYPE,'class');
    $c->addOr(SchemaPropertyPeer::TYPE,'subclass');
    $c->addAscendingOrderByColumn(SchemaPropertyPeer::NAME);
    $classes = $schema->getSchemaPropertys($c);

    $request = sfContext::getInstance()->getRequest();
    $currentPropertyId = $request->getParameter('id');
    if ("schemaprop" == $request->getParameter('module') && "edit" == $request->getParameter('action'))
    {
      foreach ($classes as $id => $property)
      {
        if ($property->getId() == $currentPropertyId)
        {
          unset($classes[$id]);
          break;
        }
      }
    }
    return $classes;
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function  retrieveByUri($uri)
  {
    $criteria = new Criteria();
    $criteria->add(self::URI, $uri);

    return self::doSelectOne($criteria);

  }

}
