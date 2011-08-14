function swapOptions()
{
  var showSelect = new Array();
    showSelect[6] = true;
    showSelect[8] = true;
    showSelect[9] = true;
    showSelect[10] = true;
    showSelect[11] = true;
    showSelect[12] = true;

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
    if(selectedName == 'isSubclassOf')
    {
      selectedId = 9;
    }
    if(selectedName == 'hasSubclass')
    {
      selectedId = 10;
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
      $('label_for_schema_property_element_object').update('URI');
      Element.hide('form_row_schema_property_element_language');

      if(6 == selectedId || 8 == selectedId)
      {
        Element.hide('form_row_schema_property_element_related_schema_class_id');
        Element.show('form_row_schema_property_element_related_schema_property_id');

        if(6 == selectedId)
        {
          $('label_for_schema_property_element_related_schema_property_id').update('Parent Property');
        }
        if(8 == selectedId)
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
        Element.hide('form_row_schema_property_element_related_schema_property_id');
        Element.show('form_row_schema_property_element_related_schema_class_id');

        if(9 == selectedId)
        {
          $('label_for_schema_property_element_related_schema_class_id').update('Parent Class');
        }
        if(10 == selectedId)
        {
          $('label_for_schema_property_element_related_schema_class_id').update('Subclass');
        }

        if(selectedId.onfocus)
        {
          $('schema_property_element_related_schema_class_id').focus();
        }
      }
    }
    else
    {
      $('label_for_schema_property_element_object').update('Value');
      Element.show('form_row_schema_property_element_language');
      Element.hide('form_row_schema_property_element_related_schema_property_id');
      Element.hide('form_row_schema_property_element_related_schema_class_id');
      $('schema_property_element_related_schema_property_id').selectedIndex = '';
      if(selectedId.onfocus)
      {
        $('schema_property_element_object').focus();
      }
    }
  }
}
Event.observe(window, 'load', swapOptions);