function swapOptions()
{
  var the_div = $('form_row_concept_property_object');
  var selectedType = $F('schema_property_type');
  if(selectedType == 'subproperty' || selectedType == 'subclass')
  {
    if(selectedType == 'subproperty')
    {
      Element.hide('form_row_schema_property_is_subclass_of');
      Element.show('form_row_schema_property_is_subproperty_of');
      Element.show('form_row_schema_property_domain');
      Element.show('form_row_schema_property_range');
      if(selectedType.onfocus)
      {
        $('schema_property_is_subproperty_of').focus();
      }
    }
    else
    {
      Element.hide('form_row_schema_property_is_subproperty_of');
      Element.show('form_row_schema_property_is_subclass_of');
      if(selectedType.onfocus)
      {
        $('schema_property_is_subclass_of').focus();
      }
    }
    Element.show('form_row_schema_property_parent_uri');
  }
  else if(selectedType == 'property')
  {
    Element.hide('form_row_schema_property_is_subproperty_of');
    Element.hide('form_row_schema_property_is_subclass_of');
    Element.hide('form_row_schema_property_parent_uri');
    Element.show('form_row_schema_property_domain');
    Element.show('form_row_schema_property_range');
  }
  else
  {
    Element.hide('form_row_schema_property_is_subproperty_of');
    Element.hide('form_row_schema_property_is_subclass_of');
    Element.hide('form_row_schema_property_parent_uri');
    Element.hide('form_row_schema_property_domain');
    Element.hide('form_row_schema_property_range');
    $('schema_property_is_subproperty_of').selectedIndex = '';
    if(selectedType.onfocus)
    {
      $('schema_property_status_id').focus();
    }
  }
}
Event.observe(window, 'load', swapOptions);