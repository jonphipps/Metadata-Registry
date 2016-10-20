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
var the_div1 = $('#form_row_concept_property_object');
var the_div2 = $('#form_row_concept_property_language');

function swapOptions()
{
  var selectedId = $('#concept_property_skos_property_id').val();

  if(vocabId == undefined)
  {
    vocabId = $('#concept_property_scheme_id').val();
  }


  if(showSelect[selectedId])
  {
    schemeSelected = $('#concept_property_scheme_id');
    if(schemeSelected.value != vocabId)
    {
      schemeSelected.value = vocabId;
      swapOptions;
    }
    $('#form_row_concept_property_language').toggle(false);
    $('#form_row_concept_property_scheme_id').toggle(false);
    $('#form_row_concept_property_related_concept_id').toggle(true);
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    $('#concept_property_related_concept_id').focus();
  }
  else if(showSelectScheme[selectedId])
  {
    $('#form_row_concept_property_language').toggle(false);
    $('#form_row_concept_property_scheme_id').toggle(true);
    $('#form_row_concept_property_related_concept_id').toggle(true);
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    $('#concept_property_scheme_id').focus();
  }
  else
  {
    $('#form_row_concept_property_language').toggle(true);
    $('#form_row_concept_property_scheme_id').toggle(false);
    $('#form_row_concept_property_related_concept_id').toggle(false);
    //Element.show('form_row_concept_property_object');
    //new Effect.BlindUp(the_div1);
    //new Effect.BlindUp(the_div2);
    $('#concept_property_related_concept_id').selectedIndex = '';
    $('#concept_property_object').focus();
  }
}

$(document).ready(swapOptions); 
  