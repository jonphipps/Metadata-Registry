@php
    /** @var array $results */
    $results = $wizard_data['results'];
    $data = json_encode($results);
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
    altrows: true,
    columns: [
        {text: 'Worksheet', datafield: 'worksheet', width: 240},
        {text: 'Processing time', datafield: 'results', width: 500},
        {text: 'Processed', datafield: 'processed', width: 240, cellsalign: 'center'},
        {text: 'Added', datafield: 'added', width: 240, cellsalign: 'center'},
        {text: 'Deleted', datafield: 'deleted', width: 240, cellsalign: 'center'},
        {text: 'Changed', datafield: 'updated', width: 240, cellsalign: 'center'},
        {text: 'Errors', datafield: 'errors', width: 240, cellsalign: 'center'},
        {text: 'History', datafield: 'history', width: 240, cellsalign: 'center'},
    ]}";
@endphp

@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
