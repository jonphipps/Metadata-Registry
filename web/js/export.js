//var $jq = jQuery.noConflict();
$(document).ready(function () {

  var $selLang = $('select#export_history_selected_language');

  $selLang.select2({
    placeholder: "Select an Additional Language (optional)",
    allowClear: true
  });

  $("#export_history_selected_columns").jqxListBox({checkboxes: true,
    allowDrop: true,
    allowDrag: true, width: 300, height: 300});

});
