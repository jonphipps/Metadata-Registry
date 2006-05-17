<?php use_helper('Javascript') ?>
<div id="related_concept" style="padding-bottom:10px; padding-right:0px; margin-right:0px; display: none ">
  <div style="padding:0; margin:0">
    <label for="concept_property[scheme_id]"><?php echo __('Select&nbsp;Vocabulary:') ?></label>
    <?php echo object_select_tag($concept_property, 'getSchemeId', array (
    'related_class' => 'Vocabulary',
    'control_name' => 'concept_property[scheme_id]',
  )) ?>
  </div>
  <div style="padding:5px 0px 0px 0px; margin:0">
    <label for="concept_property[related_concept_id]"><?php echo __('Related&nbsp;concept:') ?></label>
    <?php echo object_select_tag($concept_property, 'getRelatedConceptId', array (
    'related_class' => 'Concept',
    'related_class_method' => "getConceptsByVocabID",
    'related_class_method_arg' => $action->getVocabularyId(),
    'control_name' => 'concept_property[related_concept_id]',
    'include_blank' => 'true'
  )) ?>
  <div class="sf_admin_edit_help" style="padding:5px 0px 0px 0px; margin:0"><?php echo __('Selecting a related concept above will automatically insert the URI of that concept into the value field below (after you save it) and create a reciprocal property for the related concept. ') ?></div>
  </div>
</div>
  <?php echo object_textarea_tag($concept_property, 'getObject', array (
  'size' => '60x3',
  'control_name' => 'concept_property[object]'
)) ?>

<?php echo javascript_tag("
function swapOptions()
{
  var showSelect = new Array();
    showSelect[3] = true;
    showSelect[16] = true;
    showSelect[21] = true;
  var the_div = \$('related_concept');

  if(showSelect[\$F('concept_property[skos_property_id]')])
  {
    new Effect.BlindDown(the_div);
  }
  else
  {
    new Effect.BlindUp(the_div);
    \$('concept_property[related_concept_id]').selectedIndex = '';
  }
}"
) ?>