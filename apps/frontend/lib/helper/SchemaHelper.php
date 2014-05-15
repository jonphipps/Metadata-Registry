<?php
  include_once(SF_ROOT_DIR . '/plugins/jpAdminGeneratorPlugin/lib/helper/TextHelper.php');
  /**
   * creates a link to related SchemaProperty
   *
   * @return none
   *
   * @param  SchemaPropertyElement $property
   */
  function link_to_related($property) {
    $relSchemaPropertyId = $property->getRelatedSchemaPropertyId();
    if ($relSchemaPropertyId) {
      //get the related SchemaProperty
      $relSchemaProperty = $property->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
      if ($relSchemaProperty) {
        $link = 'schemaprop/show/?id=' . $relSchemaPropertyId;

        return link_to($relSchemaProperty, $link, ["title" => $property->getObject()]);
      }
    }
    //If the skosProperty.objectType is resource then we display a truncated URI with a complete link_to
    if (strpos(0 === $property->getObject(), sfConfig::get('app_base_domain'))) {
      return link_to(truncate_text($property->getObject(), 30), $property->getObject());
    }

    //if it's a status code, we resolve the status
    if (14 == $property->getProfilePropertyId()) {
      return $property->getStatus();
    }

    //if it's a URI we return a link
    return preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', '<a href="\0">\0</a>', $property->getObject());

    //if all else fails we display a truncated = 30 value
    //return truncate_text($property->getObject(), 30);
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
  if ($relPropertyId)
  {
    //get the related concept
    $relProperty = SchemaPropertyPeer::retrieveByPK($relPropertyId);
    if ($relProperty)
    {
      return link_to($relProperty->getLabel(), 'schemaprop/show/?id=' . $relPropertyId);
    }
  }

  //if all else fails we display a truncated = 30 value
  return truncate_text($property->getParentUri(), 30);
}
