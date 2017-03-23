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

  if(isset($version))
  {
    $versionName = urlencode($version->getName());
    echo sf_link_to('RDF', $sf_user->getAttribute('vocabulary')->getUri() . '/version/' .  $versionName . '.rdf', array('title' => 'Retrieve RDF for this vocabulary version'));
    echo "&nbsp;" . sf_link_to('XSD', $sf_user->getAttribute('vocabulary')->getUri() . '/version/' .  $versionName . '.xsd', array('title' => 'Retrieve an XML Schema for this vocabulary version'));
  }
  else
  {
    //  echo sf_link_to('RDF', '@rdf_vocabulary_timeslice?id='.$sf_user->getAttribute('vocabulary')->getId() . '&ts=' . $concept_property_history->getCreatedAt('YmdHis'), array('title' => 'Retrieve RDF for this vocabulary as of this timestamp (timeslice)'));
      echo sf_link_to('RDF', $uri . '/ts/' . $concept_property_history->getCreatedAt('YmdHis') . '.rdf', array('title' => 'Retrieve RDF for this vocabulary as of this timestamp (timeslice)'));
    if(!$sf_flash->has('hasConcept'))
    {
    //  echo "&nbsp;" . sf_link_to('XSD', '@xml_schema_vocabulary_timeslice?id='.$sf_user->getAttribute('vocabulary')->getId() . '&ts=' . $concept_property_history->getCreatedAt('YmdHis'), array('title' => 'Retrieve an XML Schema for this vocabulary as of this timestamp (timeslice)'));
      echo "&nbsp;" . sf_link_to('XSD', $uri . '/ts/' . $concept_property_history->getCreatedAt('YmdHis') . '.xsd', array('title' => 'Retrieve an XML Schema for this vocabulary as of this timestamp (timeslice)'));
      if ($sf_user->hasObjectCredential($concept_property_history->getVocabularyId(), 'vocabulary',  array (   0 =>    array (     0 => 'administrator',     1 => 'vocabularyadmin',   ), )))
      {
      echo "&nbsp;" . sf_link_to('Name', 'version/create?ts=' . $concept_property_history->getCreatedAt('YmdHis'), array('title' => 'Create a named version for this TimeSlice'));
      }
    }
  } ?>
