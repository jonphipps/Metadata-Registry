@if (isset($wizard_data['approve']))
    @php
        /** @var array $worksheets */
        $data = json_encode($wizard_data['approve']);
        $selected = $wizard_data['approve']['selected_worksheets'] ?? json_encode([]);
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
        {text: 'Worksheet', datafield: 'worksheet'},
        {text: 'Added', datafield: 'added', columntype: number},
        {text: 'Deleted', datafield: 'deleted', columntype: number},
        {text: 'Changed', datafield: 'updated', columntype: number},
        {text: 'Errors', datafield: 'errors', columntype: number},
        ]}";
    @endphp
    @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
@endif

<h3>What happens next...</h3>
<p>The Worksheets you selected for processing have been queued as a series of 'import' tasks on the server.
    They'll be checked for errors and a set of import instructions will be generated for each Worksheet.
    As each Worksheet is processed you'll receive a notification with a link to a page that will display some statistics about the import and ask if you want to proceed.
If you approve, the import will continue and the Vocabulary or Element Set will be sent to the server for importing.
When the import completes, you'll receive another notification of a successful import.</p>
