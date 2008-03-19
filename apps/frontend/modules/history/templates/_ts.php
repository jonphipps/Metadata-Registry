<?php
//  echo link_to('RDF', '@rdf_vocabulary_timeslice?id='.$sf_user->getAttribute('vocabulary')->getId() . '&ts=' . $concept_property_history->getCreatedAt('YmdHis'), array('title' => 'Retrieve RDF for this vocabulary as of this timestamp (timeslice)'));
  echo link_to('RDF', $sf_user->getAttribute('vocabulary')->getUri() . '/ts/' . $concept_property_history->getCreatedAt('YmdHis') . '.rdf', array('title' => 'Retrieve RDF for this vocabulary as of this timestamp (timeslice)'));
      ?>