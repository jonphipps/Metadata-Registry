<?php
  /** @var ConceptPropertyHistory $concept_property_history **/
  if ($concept_property_history->getConceptProperty())
  {
    echo link_to($concept_property_history->getSkosProperty()->getName() ? $concept_property_history->getSkosProperty()->getName() : __('-'), 'conceptprop/show?id='.$concept_property_history->getConceptPropertyId());
  }
  else
  {
    echo $concept_property_history->getSkosProperty()->getName() ? $concept_property_history->getSkosProperty()->getName() : __('-');
  }
?>
