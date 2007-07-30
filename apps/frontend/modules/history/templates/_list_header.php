<h1>
<?php
  //debugbreak();
  use_helper('TruncateUri', 'Text');
  $spaceCount = 0;

  if ($sf_params->get('vocabulary_id') || $sf_user->getAttribute('vocabulary_id', null, 'sf_admin/concept_property_history/filters'))
  {
    $vocabId = (is_null($sf_params->get('vocabulary_id'))) ? $sf_user->getAttribute('vocabulary_id', null, 'sf_admin/concept_property_history/filters') : $sf_params->get('vocabulary_id');
  }

  if ($sf_params->get('concept_id') || $sf_user->getAttribute('concept_id', null, 'sf_admin/concept_property_history/filters'))
  {
    $conceptId = (is_null($sf_params->get('concept_id'))) ? $sf_user->getAttribute('concept_id', null, 'sf_admin/concept_property_history/filters') : $sf_params->get('concept_id');
    if ($conceptId)
    {
      $concept = ConceptPeer::retrieveByPK($conceptId);
      $vocabId = $concept->getVocabularyId();
    }
  }

  if ($sf_params->get('property_id') || $sf_user->getAttribute('concept_property_id', null, 'sf_admin/concept_property_history/filters'))
  {
    $propertyId = (is_null($sf_params->get('property_id'))) ? $sf_user->getAttribute('concept_property_id', null, 'sf_admin/concept_property_history/filters') : $sf_params->get('property_id');
    if ($propertyId)
    {
      $property = ConceptPropertyPeer::retrieveByPK($propertyId);
      $conceptId = $property->getConceptId();
      $concept = $property->getConceptRelatedByConceptId();
      $vocabId = $concept->getVocabularyId();
    }
  }

  if (isset($vocabId))
  {
    $vocabulary = VocabularyPeer::retrieveByPK($vocabId);
    $vocabName = $vocabulary->getName();
    echo link_to('Vocabulary: ', 'vocabulary/list');
    echo link_to($vocabName, 'vocabulary/show?id=' . $vocabId);
    $spaceCount++;
  }

  if (isset($conceptId))
  {
    echo '<br />&nbsp;&nbsp;' . link_to('Concept: ', '/concept/list?vocabulary_id=' . $vocabId);
    echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $conceptId);
    $spaceCount++;
  }

  if (isset($propertyId))
  {
    echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;' . link_to('Property: ', '/conceptprop/list?concept_id=' . $conceptId);
    echo link_to($property->getSkosProperty()->getName(), '/conceptprop/show?id=' . $propertyId);
    $spaceCount++;
  }

  if ($spaceCount)
  {
    $spaces = '';
    for($i=0; $i<=$spaceCount; $i++)
    {
      $spaces .= "&nbsp;&nbsp;";
    }

    echo "<br />" . $spaces . 'History of Changes';
  }
  else
  {
    echo "History of all Changes";
  }
?>
</h1>