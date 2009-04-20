<?php
  include_once(sfConfig::get('sf_symfony_lib_dir').'/helper/TextHelper.php');
  /**
  * creates a link to related SchemaProperty
  *
  * @return none
  * @param  SchemaPropertyproperty $property
  */
  function link_to_related($property)
{
  //debugbreak();
  $relSchemaPropertyId = $property->getRelatedSchemaPropertyId();
  if ($relSchemaPropertyId)
  {
    //get the related SchemaProperty
    $relSchemaProperty = $property->getSchemaPropertyRelatedByRelatedSchemaPropertyId();
    if ($relSchemaProperty)
    {
      return link_to($relSchemaProperty, 'schemaprop/show/?id=' . $relSchemaPropertyId);
    }
  }
  //If the skosProperty.objectType is resource then we display a truncated URI with a complete link_to
  if (strpos(0 === $property->getObject(),sfConfig::get('app_base_domain')))
  {
    return link_to(truncate_text($property->getObject(), 30), $property->getObject());
  }

  //if all else fails we display a truncated = 30 value
  return truncate_text($property->getObject(), 30);
}

