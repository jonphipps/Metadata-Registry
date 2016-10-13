//var $jq = jQuery.noConflict();
$(document).ready(function () {

    var $selLang = $('select#export_history_selected_language');

    $selLang.select2({
        placeholder: "Select an Additional Language (optional)",
        allowClear: true
    });

    $("#export_history_selected_columns").jqxListBox({
        checkboxes: true,
        allowDrop: true,
        allowDrag: true, width: 300, height: 300
    });

    var items = $("#export_history_selected_columns").jqxListBox('getCheckedItems');
    if (!items.length) {
        $("#export_history_selected_columns").jqxListBox('checkAll');
    }

    $("#export_history_selected_columns").on('checkChange', function (event) {
        var args = event.args;
        if (args) {
            var item = args.item;
            var label = item.label;
            if (label[0] === "*" && item.checked === false) {
                $("#export_history_selected_columns").jqxListBox('checkItem', item);
                return;
            }
        }
    });

    $( "#sf_admin_edit_form" ).submit(function( event ) {
        var options = $("#export_history_selected_columns_jqxListBox option");
        var jqoptions = $("#export_history_selected_columns_jqxListBox").jqxListBox('getItems'); 
        //replace the values in the existing options with the jqoptions
        z=0;
        for (var i = 0; i < jqoptions.length; i++){
            if (!jqoptions[i].isGroup) {
                options[z].value    = jqoptions[i].value;
                options[z].selected = jqoptions[i].checked;
                z++;
            }
        }

    return;

});

});

