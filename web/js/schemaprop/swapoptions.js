function swapOptions()
{
  //var the_div = $('form_row_concept_property_object');
  var selectedType;
  if ($("#form_row_content_schema_property_mytype")){
     selectedType = document.getElementById("form_row_content_schema_property_mytype").innerHTML.trim();
  } else {
     selectedType = $('#schema_property_type').val();
  }

    //showHideParent();
    if(selectedType == 'property' || selectedType == 'subproperty')
    {
        $('#form_row_schema_property_is_subclass_of').toggle(false);
        $('#form_row_schema_property_domain').toggle(true);
        $('#form_row_schema_property_orange').toggle(true);
        $('#form_row_schema_property_is_subproperty_of').toggle(true);
    }
    else
    {
      $('#form_row_schema_property_is_subproperty_of').toggle(false);
      $('#form_row_schema_property_domain').toggle(false);
      $('#form_row_schema_property_orange').toggle(false);
      $('#form_row_schema_property_is_subclass_of').toggle(true);
      $('#schema_property_is_subproperty_of').selectedIndex = '';
    }

}

function showHideParent(){
      if ((!document.getElementById("#schema_property_is_subclass_of").val() &&
        !document.getElementById("#schema_property_is_subproperty_of").val()) &&
        !document.getElementById("#schema_property_parent_uri").val()
    ){
      $('#form_row_schema_property_parent_uri').toggle(false);
    } else {
     $('#form_row_schema_property_parent_uri').toggle(true);
    }
}

$(document).ready(swapOptions);
