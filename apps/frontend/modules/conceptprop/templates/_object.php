<?php //@DEPRECATED
$value = object_textarea_tag($concept_property, 'getObject', array (
  'size' => '55x3',
  'control_name' => 'concept_property[object]',
)); echo $value ? $value : '&nbsp;' ?>

<?php echo javascript_tag("
//Element.hide('form_row_concept_property_scheme_id', 'form_row_concept_property_related_concept_id');
function swapOptions()
{
  var showSelect = new Array();
    showSelect[3] = true;
    showSelect[16] = true;
    showSelect[21] = true;
  var the_div1 = \$('form_row_concept_property_object');
  var the_div2 = \$('form_row_concept_property_language');

  var selectedId = \$F('concept_property_skos_property_id');
  if(showSelect[selectedId])
  {
    Element.show('form_row_concept_property_scheme_id','form_row_concept_property_related_concept_id');
    Element.hide('form_row_concept_property_language');
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    \$('concept_property_scheme_id').focus();
  }
  else
  {
    Element.hide('form_row_concept_property_scheme_id','form_row_concept_property_related_concept_id');
    Element.show('form_row_concept_property_language');
    //Element.show('form_row_concept_property_object');
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    \$('concept_property_related_concept_id').selectedIndex = '';
    \$('concept_property_object').focus();
  }
}
swapOptions();"
) ?>