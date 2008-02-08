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
    $metaTitle = __('History of %%vocabulary%%',
    array('%%vocabulary%%' => $vocabulary->getName()));
    $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $metaTitle);
  }

  if (isset($conceptId))
  {
    echo '<br />&nbsp;&nbsp;' . link_to('Concepts: ', '/concept/list?vocabulary_id=' . $vocabId);
    echo link_to($concept->getPrefLabel(), '/concept/show?id=' . $conceptId);
    $spaceCount++;
    $metaTitle = __('%%vocabulary%% :: History of %%pref_label%%',
    array('%%vocabulary%%' => $vocabulary->getName(), '%%pref_label%%' => $concept->getPrefLabel()));
    $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $metaTitle);
  }

  if (isset($propertyId))
  {
    echo '<br />&nbsp;&nbsp;&nbsp;&nbsp;' . link_to('Properties: ', '/conceptprop/list?concept_id=' . $conceptId);
    echo $property->getSkosProperty()->getName();
    $spaceCount++;
    $metaTitle = __('%%vocabulary%% :: %%pref_label%% :: History of %%__%% property',
    array('%%vocabulary%%' => $vocabulary->getName(), '%%pref_label%%' => $concept->getPrefLabel()));
    $sf_context->getResponse()->setTitle(sfConfig::get('app_title_prefix') . $metaTitle);
  }

  if ($spaceCount)
  {
    $spaces = '';
    for($i=0; $i<=$spaceCount; $i++)
    {
      $spaces .= "&nbsp;&nbsp;";
    }

//    echo "<br />" . $spaces . 'History of Changes';
  }
  else
  {
    echo "History of all Changes";
  }
?>
</h1>
<?php
  if (isset($propertyId))
  {
    include_partial('global/propertynav', array('concept_property' => $property));
  }
  elseif (isset($conceptId))
  {
    include_partial('global/conceptnav', array('concept' => $concept));
  }
  elseif (isset($vocabId))
  {
    include_partial('global/vocabnav', array('vocabulary' => $vocabulary));
  }