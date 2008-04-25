function swapOptions()
{
  var showSelect = new Array();
    showSelect[6] = true;
    showSelect[8] = true;

  if($F('id'))
  {
    var selectedName = $F('schema_property_element_profile_property');
    if(selectedName == 'isSubpropertyOf')
    {
      selectedId = 6;
    }
    if(selectedName == 'hasSubproperty')
    {
      selectedId = 8;
    }
  }
  else
  {
    var selectedId = $F('schema_property_element_profile_property_id');
  }
  if(selectedId)
  {
    if(showSelect[selectedId])
    {
      Element.hide('form_row_schema_property_element_object');
      Element.hide('form_row_schema_property_element_language');
      Element.show('form_row_schema_property_element_related_schema_property_id');
      if(6 == selectedId)
      {
        $('label_for_schema_property_element_related_schema_property_id').update('Parent Property');
      }
      else
      {
        $('label_for_schema_property_element_related_schema_property_id').update('Subproperty');
      }

      if(selectedId.onfocus)
      {
        $('schema_property_element_related_schema_property_id').focus();
      }
    }
    else
    {
      Element.show('form_row_schema_property_element_language');
      Element.show('form_row_schema_property_element_object');
      Element.hide('form_row_schema_property_element_related_schema_property_id');
      $('schema_property_element_related_schema_property_id').selectedIndex = '';
      if(selectedId.onfocus)
      {
        $('schema_property_element_object').focus();
      }
    }
  }
}
Event.observe(window, 'load', swapOptions);