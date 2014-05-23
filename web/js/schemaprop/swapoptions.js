function swapOptions()
{
  //var the_div = $('form_row_concept_property_object');
  var selectedType;
  if (document.getElementsByName("form_row_content_schema_property_mytype").length !== 0){
     selectedType = $F('schema_property_type');
  } else {
     selectedType = $('form_row_content_schema_property_mytype').innerHTML.strip();
  }



    //showHideParent();
    if(selectedType == 'property' || selectedType == 'subproperty')
    {
      Element.hide('form_row_schema_property_is_subclass_of');
      Element.show('form_row_schema_property_domain');
      Element.show('form_row_schema_property_orange');
      Element.show('form_row_schema_property_is_subproperty_of');
    }
    else
    {
      Element.hide('form_row_schema_property_is_subproperty_of');
      Element.hide('form_row_schema_property_domain');
      Element.hide('form_row_schema_property_orange');
      Element.show('form_row_schema_property_is_subclass_of');
      $('schema_property_is_subproperty_of').selectedIndex = '';
    }

}

function showHideParent(){
      if ((!document.getElementById("schema_property_is_subclass_of").value &&
        !document.getElementById("schema_property_is_subproperty_of").value) &&
        !document.getElementById("schema_property_parent_uri").value
    ){
      Element.hide('form_row_schema_property_parent_uri');
    } else {
      Element.show('form_row_schema_property_parent_uri');
    }
}
Event.observe(window, 'load', swapOptions);
