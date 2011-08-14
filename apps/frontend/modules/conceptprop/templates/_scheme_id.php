  <?php if ($sf_request->hasError('concept_property{scheme_id}')): ?>
    <?php echo form_error('concept_property{scheme_id}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>

  <?php $value = object_select_tag($concept_property, 'getSchemeId', array (
  'related_class' => 'Vocabulary',
  'include_blank'=> false,
  'control_name' => 'concept_property[scheme_id]',
  'onchange' => remote_function(array(
      'url' => '/concept/getConceptList',
      'update' => 'form_row_content_concept_property_related_concept_id',
      'loading' => "Element.update('form_row_content_concept_property_related_concept_id','Please wait...')",
      'complete' => "\$('concept_property_related_concept_id').focus();",
      'with' => "'selectedVocabularyId='+value",
      'script' => 'true'))
), $sf_flash->get('vocabID')); echo $value ? $value : '&nbsp;' ?>
