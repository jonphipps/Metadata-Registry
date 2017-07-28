@php
    /** @var array $worksheets */
    $data = json_encode($wizard_data['results']);
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
        {text: 'Results', datafield: 'results', width: 500},
        {text: 'Processed', datafield: 'processed', width: 240, cellsalign: 'center'},
        {text: 'Errors', datafield: 'errors', width: 240, cellsalign: 'center'},
    ]}";
@endphp
@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
