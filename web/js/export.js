//var $jq = jQuery.noConflict();
$(document).ready(function () {

    $('select#export_history_selected_language').select2({
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

    $('#label_for_export_history_selected_columns').append(
    '<p style="margin-top: .3em; margin-left: .8em; white-space: nowrap;">' +
    '<label><input type="radio" name="selectCols" id="select_all" style="margin-right: .4em;"> Select all</label></p>' +
    '<p style=" margin-left: .8em; white-space: nowrap;">' +
    '<label><input type="radio" name="selectCols" id="select_in_use" style="margin-right: .4em;"> Select only in use</label></p>' +
    '<p style=" margin-left: .8em; white-space: nowrap;">' +
    '<label><input type="radio" name="selectCols" id="select_none" style="margin-right: .4em;"> Select none</label></p>');

    $("#select_all").change(function (event) {
        if (this.checked) {
            $("#export_history_selected_columns").jqxListBox('checkAll'); 
        }
    });
    $("#select_in_use").change(function (event) {
        if (this.checked) {
            $("#export_history_selected_columns").jqxListBox('uncheckAll'); 
            var jqbox = $("#export_history_selected_columns").jqxListBox('uncheckAll'); 
            if( propertiesInUse !== 'undefined' ) {
                for (var i = 0; i < propertiesInUse.length; i++){
                    var item = $("#export_history_selected_columns").jqxListBox('getItemByValue', propertiesInUse[i]); 
                    if(item !== 'undefined') {
                        $("#export_history_selected_columns").jqxListBox('checkItem', item ); 
                    }
                }
            }
            checkRequired();
        }
    });
    $("#select_none").change(function (event) {
        if (this.checked) {
            $("#export_history_selected_columns").jqxListBox('uncheckAll');
            checkRequired(); 
        }
    });

    function checkRequired(){
        var items = $("#export_history_selected_columns").jqxListBox('getItems'); 
        //replace the values in the existing options with the jqoptions
        for (var i = 0; i < items.length; i++){
            var item = items[i];
            var label = item.label;
            if (label[0] === "*" && item.checked === false) {
                $("#export_history_selected_columns").jqxListBox('checkItem', item);
            }
        }

        return;

    }

    $(function(){
        var tabindex = 1;
        $('#sf_admin_edit_form').find('input,select').each(function() {
            if (this.offsetWidth > 0 || this.offsetHeight > 0) {
                var $input = $(this);
                $input.attr("tabindex", tabindex);
                tabindex++;
            }
        });
        $("#select_all").focus();
    });


});

