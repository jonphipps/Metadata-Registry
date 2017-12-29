<h4>Note:</h4><p>The counts you see here will always be based on a comparison of the worksheet data to the <em>original</em> export,
    not to the results of the import, which hasn't happened yet.<br/>
    The import results will be displayed on the 'results' page.</p>
@if (isset($wizard_data['approve']))
    @php
        /** @var array $worksheets */
        $data = json_encode($wizard_data['approve']['data']);
        $wizardErrors = json_encode($wizard_data['approve']['errors']);
        $errorTable = '';
        foreach ($wizard_data['approve']['errors'] as $key => $errorType) {
            $errorTable .= "<table class=\"table table-condensed\"><caption>Worksheet: {$key}</caption>";
            foreach ( $errorType as $type => $errorRows) {
                $errorTable .= <<<TAG
<thead>
                <tr><th colspan = "4">{$type}</th></tr>
                <tr><th>ID</th><th>Column</th><th>Error</th><th>Severity</th></tr>
                </thead>
TAG;
                foreach ($errorRows as $errorRow) {
                    $errorTable .= "<tr>";
                    foreach ($errorRow as $item) {
                        $errorTable .= "<td>{$item}</td>";
                    }
                    $errorTable .= "</tr>";
                    }
                }
                $errorTable .= "</table>";
        }
        $selected = $wizard_data['approve']['selected_worksheets'] ?? json_encode([]);
        $props = "{
        width: '100%',
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
        {text: 'Worksheet', datafield: 'worksheet', width: '50%'},
        {text: 'Added', datafield: 'added', width: '10%', cellsalign: 'center'},
        {text: 'Deleted', datafield: 'deleted', width: '10%', cellsalign: 'center'},
        {text: 'Changed', datafield: 'updated', width: '10%', cellsalign: 'center'},
        {text: 'Errors', datafield: 'errors', width: '10%', cellsalign: 'center'},
       ]}";
    @endphp
    @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
@endif
<h3>What happens next...</h3>
<p>The Imports you select for processing will be sent to the server for importing.
When the import completes, you'll receive another notification of a successful import with a link to a page displaying the results.</p>
