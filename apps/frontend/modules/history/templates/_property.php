<?php
/** @var ConceptPropertyHistory $concept_property_history **/
$skosName = $concept_property_history->getSkosProperty() ? $concept_property_history->getSkosProperty()->getName() : null;

if ($concept_property_history->getConceptProperty())
  {
    echo sf_link_to($skosName ? $skosName : __s('-'), 'conceptprop/show?id='.$concept_property_history->getConceptPropertyId());
  }
  else
  {
    echo $skosName ? $skosName : __s('-');
  }
?>
