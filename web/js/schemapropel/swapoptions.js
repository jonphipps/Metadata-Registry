function swapOptions() {
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

  var selectedId = $('#schema_property_element_profile_property_id').val();
  if ($('#id').val()) {
    switch ($('#schema_property_element_profile_property').val()) {
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
        selectedId = $('#schema_property_element_profile_property_id').val()
    }
  }

  if (selectedId) {
    if (showSelect[selectedId]) {
      $('#label_for_schema_property_element_object').val('URI');
      $('#form_row_schema_property_element_language').toggle(false);

      if (6 == selectedId || 8 == selectedId || 17 == selectedId || 19 == selectedId) {
        $('#form_row_schema_property_element_related_schema_class_id').toggle(false);
        $('#form_row_schema_property_element_related_schema_property_id').toggle(true);

        if (6 == selectedId) {
          $('#label_for_schema_property_element_related_schema_property_id').val('Parent Property');
        }
        if (8 == selectedId) {
          $('#label_for_schema_property_element_related_schema_property_id').val('Subproperty');
        }
        if (selectedId.onfocus) {
          $('#schema_property_element_related_schema_property_id').focus();
        }
      }
      else {
        $('#form_row_schema_property_element_related_schema_property_id').toggle(false);
        $('#form_row_schema_property_element_related_schema_class_id').toggle(true);

        if (9 == selectedId) {
          $('#label_for_schema_property_element_related_schema_class_id').val('Parent Class');
        }
        if (10 == selectedId) {
          $('#label_for_schema_property_element_related_schema_class_id').val('Subclass');
        }

        if (selectedId.onfocus) {
          $('#schema_property_element_related_schema_class_id').focus();
        }
      }
    }
    else {
      $('#label_for_schema_property_element_object').val('Value');
      $('#form_row_schema_property_element_language').toggle(true);
      $('#form_row_schema_property_element_related_schema_property_id').toggle(false);
      $('#form_row_schema_property_element_related_schema_class_id').toggle(false);
      $('#schema_property_element_related_schema_property_id').selectedIndex = '';
      if (selectedId.onfocus) {
        $('#schema_property_element_object').focus();
      }
    }
  }
}

$(document).ready(swapOptions);
