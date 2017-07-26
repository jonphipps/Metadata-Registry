@php
    /** @var array $worksheets */
    $data = json_encode($wizard_data['googlesheets']);
    $selected = $wizard_data['worksheets']['selected_worksheets'] ?? json_encode([]);
    $props = "{
    width: 1000,
    autoheight: true,
    source: dataAdapter,
    sortable: true,
    //filterable: true,
    pageable: false,
    //scrollbarsize: 0,
    ready: function () {
    // called when the Grid is loaded. Call methods or set properties here.
    },
    selectionmode: 'checkbox',
    altrows: true,
    columns: [
    {text: 'id', datafield: 'id', hidden: true},
    {text: 'Worksheet', datafield: 'worksheet', width: 240},
    {text: 'Languages', datafield: 'languages', width: 100},
    {text: 'Exported At', datafield: 'exported_at', width: 235},
    {text: 'Last Import', datafield: 'last_import', width: 235},
    {text: 'Last OMR Edit', datafield: 'last_edit', width: 235},
    ]}";
@endphp
@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
