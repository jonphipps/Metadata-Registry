<?php
  include_once(sfConfig::get('sf_symfony_lib_dir').'/helper/TextHelper.php');
  /**
  * creates a link to related concept
  *
  * @return none
  * @param  conceptproperty $property
  */
  function link_to_related($property)
{
  $relConceptId = $property->getRelatedConceptId();
  if ($relConceptId)
  {
    //get the related concept
    $relConcept = ConceptPeer::retrieveByPK($relConceptId);
    if ($relConcept)
    {
      return link_to($relConcept->getPrefLabel(), 'concept/show/?id=' . $relConceptId);
    }
  }
  //If the skosProperty.objectType is resource then we display a truncated URI with a complete link_to
  if ($property->getProfileProperty()->getIsObjectProp())
  {
    return link_to(truncate_text($property->getObject(), 30), $property->getObject());
  }

  //if all else fails we display a truncated = 30 value
  return truncate_text($property->getObject(), 30);
}

