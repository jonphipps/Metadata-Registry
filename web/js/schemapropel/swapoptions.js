function swapOptions()
{
  var showSelect = new Array();
    showSelect[6] = true;
    showSelect[8] = true;
    showSelect[9] = true;
    showSelect[10] = true;
    showSelect[11] = true;
    showSelect[12] = true;
    showSelect[13] = true;
    showSelect[14] = true;
    showSelect[15] = true;
    showSelect[16] = true;
    showSelect[17] = true;
    showSelect[18] = true;
    showSelect[19] = true;
    showSelect[20] = true;
    showSelect[23] = true;
    showSelect[24] = true;
    showSelect[25] = true;
    showSelect[26] = true;

  var selectedId = $F('schema_property_element_profile_property_id');
  if($F('id') && document.getElementById("schema_property_element_profile_property")){
    switch ($F('schema_property_element_profile_property')) {
      case 'isSubpropertyOf':
        selectedId = 6;
        break;
      case 'hasSubproperty':
        selectedId = 8;
        break;
      case 'isSubclassOf':
        selectedId = 9;
        break;
      case 'hasSubclass':
        selectedId = 10;
        break;
      default:
        selectedId = $F('schema_property_element_profile_property_id');
    }
  }

  if(selectedId)
  {
    if(showSelect[selectedId])
    {
      $('label_for_schema_property_element_object').update('URI');
      Element.hide('form_row_schema_property_element_language');

      if(6 == selectedId || 8 == selectedId || 17 == selectedId || 19 == selectedId)
      {
        if (document.getElementById("form_row_schema_property_element_related_schema_class_id")) {
          Element.hide('form_row_schema_property_element_related_schema_class_id');
        }
        if (document.getElementById("form_row_schema_property_element_related_schema_property_id")) {
          Element.show('form_row_schema_property_element_related_schema_property_id');
        }

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
        if (document.getElementById("form_row_schema_property_element_related_schema_property_id")) {
          Element.hide('form_row_schema_property_element_related_schema_property_id');
        }
        if (document.getElementById("form_row_schema_property_element_related_schema_class_id")) {
          Element.show('form_row_schema_property_element_related_schema_class_id');
        }

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
