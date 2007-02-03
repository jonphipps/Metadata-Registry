<?php if ($sf_request->hasError('concept_property{related_concept_id}')): ?>
   <?php echo form_error('concept_property{related_concept_id}', array('class' => 'form-error-msg')) ?>
<?php endif; ?>
<?php $value = select_tag('concept_property[related_concept_id]', options_for_select($concepts));
  echo $value ? $value : '&nbsp;' ?>