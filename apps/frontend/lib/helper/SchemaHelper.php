<?php
  include_once(SF_ROOT_DIR.'/plugins/jpAdminGeneratorPlugin/lib/helper/TextHelper.php');
  /**
  * creates a link to related SchemaProperty
  *
  * @return none
   *
  * @param  SchemaPropertyElement $property
  */
  function link_to_related($property)
{

  $relSchemaPropertyId = $property->getRelatedSchemaPropertyId();
  if ($relSchemaPropertyId)
  {
    //get the related SchemaProperty
    $relSchemaProperty = $property->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
      if ($relSchemaProperty) {
        $link = 'schemaprop/show/?id=' . $relSchemaPropertyId;

        return link_to($property->getObject(), $link, ["title" => $relSchemaProperty]);
    }
  }
  //If the skosProperty.objectType is resource then we display a truncated URI with a complete link_to
  if (strpos(0 === $property->getObject(),sfConfig::get('app_base_domain')))
  {
    return link_to(truncate_text($property->getObject(), 30), $property->getObject());
  }

  //if it's a status code, we resolve the status
  if (14 == $property->getProfilePropertyId())
  {
    return $property->getStatus();
  }

    //if it's a URI we return a link, but if it's not we just return the object
    //return preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', '<a href="\0">\0</a>', $property->getObject());
  //if all else fails we display a truncated = 30 value
    return $property->getObject();
}

/**
* creates a link to related schema property
*
* @return none
* @param  schemaproperty $property
*/
function link_to_related_property($property)
{
  $relPropertyId = $property->getIsSubpropertyOf();
  $relPropertyUri = $property->getParentUri();
  if ($relPropertyId)
  {
    //get the related concept
    $relProperty = SchemaPropertyPeer::retrieveByPK($relPropertyId);
    if ($relProperty)
    {
      return link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relPropertyId, ['title' => $relPropertyUri]);
    }
  }

  //if all else fails we display a truncated = 30 value
  return truncate_text($property->getParentUri(), 30);
}
  /**
   * @param integer $userId
   */
  function select_schema_for_user($userId)
{
  $schemas = schema_for_user_select_array($userId);
}
  /**
   * @param integer $schemaId
   */
  function select_elements_for_schema($schemaId)
{
}
  /**
   * Builds a multi-dimensional array of Schemas[SchemaProperties]
   * Optionally returns a script tag
   *
   * @param integer $userId
   *
   * @param bool    $makeScript
   * @param string  $var
   *
   * @return array
   */
  function schema_for_user_select_array($userId, $makeScript = FALSE, $var = '') {
    //get the schemas for a user
    $schemasArray = SchemaHasUserPeer::getSchemasForUser($userId);
    $schemas      = array();
    /** @var $schema Schema */
    foreach ($schemasArray as $schema) {
      //select schema properties to add to array
      $schemaId = $schema->getId();
      $schemas[ $schemaId ] = array(
        'name'       => $schema->getName(),
        'uri'        => $schema->getUri(),
        'properties' => array()
      );
      $schemaPropArray = SchemaPropertyPeer::getElementsForSchema($schemaId);
      /** @var $element SchemaProperty */
      foreach ($schemaPropArray as $schemaProp) {
        $schemaPropId = $schemaProp->getId();
        $schemas[ $schemaId ]['properties'][ $schemaPropId ] = array(
          'name' => $schemaProp->getLabel(),
          'uri'  => $schemaProp->getUri(),
          'type' => $schemaProp->getType()
        );
      }
    }
    if ($makeScript) {
      $var     = ($var) ? $var : "data";
      $content = "var $var = " . json_encode($schemas);
      return javascript_tag($content);
    }
    return $schemas;
  }
