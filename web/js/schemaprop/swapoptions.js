function swapOptions()
{
  var the_div = $('form_row_concept_property_object');
  var selectedType = $F('schema_property_type');
  if(selectedType == 'subproperty')
  {
    Element.show('form_row_schema_property_is_subproperty_of');
    if(selectedType.onfocus)
    {
      $('schema_property_is_subproperty_of').focus();
    }
  }
  else
  {
    Element.hide('form_row_schema_property_is_subproperty_of');
    $('schema_property_is_subproperty_of').selectedIndex = '';
    if(selectedType.onfocus)
    {
      $('schema_property_status_id').focus();
    }
  }
}
Event.observe(window, 'load', swapOptions);