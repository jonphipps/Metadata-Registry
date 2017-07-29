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
        {text: 'Worksheet', datafield: 'worksheet', width: 240},
        {text: 'Added', datafield: 'added', width: 240, cellsalign: 'center'},
        {text: 'Deleted', datafield: 'deleted', width: 240, cellsalign: 'center'},
        {text: 'Changed', datafield: 'updated', width: 240, cellsalign: 'center'},
        {text: 'Errors', datafield: 'errors', width: 240, cellsalign: 'center'},
        ]}";
    @endphp
    @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
@endif
<h3>Note:</h3>
<p>The counts you see here will always be based on a comparison of the new data to the original export, not to the results of the actual import.
    The import results will be displayed on the 'results' page.</p>
<h3>What happens next...</h3>
<p>The Imports you select for processing will be sent to the server for importing.
When the import completes, you'll receive another notification of a successful import with a link to a page displaying the results.</p>
