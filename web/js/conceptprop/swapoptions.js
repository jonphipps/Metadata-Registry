//Element.hide('form_row_concept_property_scheme_id', 'form_row_concept_property_related_concept_id');
var showSelect = new Array();
  showSelect[3] = true;
  showSelect[16] = true;
  showSelect[21] = true;
var showSelectScheme = new Array();
  showSelectScheme[32] = true;
  showSelectScheme[33] = true;
  showSelectScheme[34] = true;
  showSelectScheme[35] = true;
  showSelectScheme[36] = true;
  showSelectScheme[37] = true;
var vocabId;
var the_div1 = $('form_row_concept_property_object');
var the_div2 = $('form_row_concept_property_language');

function swapOptions()
{
  var selectedId = $F('concept_property_skos_property_id');

  if(vocabId == null)
  {
    vocabId = $F('concept_property_scheme_id');
  }

  if(showSelect[selectedId])
  {
    schemeSelected = $('concept_property_scheme_id');
    if(schemeSelected.value != vocabId)
    {
      schemeSelected.value = vocabId;
      schemeSelected.onchange();
    }
    Element.hide('form_row_concept_property_language');
    Element.hide('form_row_concept_property_scheme_id');
    Element.show('form_row_concept_property_related_concept_id');
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    $('concept_property_related_concept_id').focus();
  }
  else if(showSelectScheme[selectedId])
  {
    Element.hide('form_row_concept_property_language');
    Element.show('form_row_concept_property_scheme_id');
    Element.show('form_row_concept_property_related_concept_id');
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    $('concept_property_scheme_id').focus();
  }
  else
  {
    Element.show('form_row_concept_property_language');
    Element.hide('form_row_concept_property_scheme_id');
    Element.hide('form_row_concept_property_related_concept_id');
    //Element.show('form_row_concept_property_object');
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    $('concept_property_related_concept_id').selectedIndex = '';
    $('concept_property_object').focus();
  }
}
Event.observe(window, 'load', swapOptions);