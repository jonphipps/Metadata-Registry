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

<h3>What happens next...</h3>
<p>The Worksheets you select for processing will be queued as a series of 'import' tasks on the server.<br />
    They'll be checked for errors and a set of import instructions will be generated for each Worksheet.<br/>
    When the worksheets are finished processing, you'll receive a notification with a link to a page that will display some statistics about the import instructions and ask if you want to proceed.
</p>
