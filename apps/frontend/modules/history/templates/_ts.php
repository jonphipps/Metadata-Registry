<?php
  $concept = $sf_user->getAttribute('concept');
  if ($sf_flash->has('hasConcept'))
  {
    $uri = $sf_user->getAttribute('concept')->getUri();
  }
  else
  {
    $uri = $sf_user->getAttribute('vocabulary')->getUri();
  }
//  echo link_to('RDF', '@rdf_vocabulary_timeslice?id='.$sf_user->getAttribute('vocabulary')->getId() . '&ts=' . $concept_property_history->getCreatedAt('YmdHis'), array('title' => 'Retrieve RDF for this vocabulary as of this timestamp (timeslice)'));
  echo link_to('RDF', $uri . '/ts/' . $concept_property_history->getCreatedAt('YmdHis') . '.rdf', array('title' => 'Retrieve RDF for this vocabulary as of this timestamp (timeslice)'));
if(!$sf_flash->has('hasConcept'))
{
//  echo "&nbsp;" . link_to('XSD', '@xml_schema_vocabulary_timeslice?id='.$sf_user->getAttribute('vocabulary')->getId() . '&ts=' . $concept_property_history->getCreatedAt('YmdHis'), array('title' => 'Retrieve an XML Schema for this vocabulary as of this timestamp (timeslice)'));
  echo "&nbsp;" . link_to('XSD', $uri . '/ts/' . $concept_property_history->getCreatedAt('YmdHis') . '.xsd', array('title' => 'Retrieve an XML Schema for this vocabulary as of this timestamp (timeslice)'));
} ?>