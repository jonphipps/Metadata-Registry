@php $tree =
    '<table><thead>
    <tr><td>ID</td><td>Resource Label</td><td>Property Label</td><td>Import Value</td><td>OMR Value</td><td>Last Updated</td></tr></thead>
    <tr>
        <td><a href="https://stage.metadataregistry.org/properties/25206">25206</a></td>
        <td><a href="https://stage.metadataregistry.org/concepts/511">cartographic image</a></td>
        <td>Toolkit Label</td>
        <td>imagen cartográfica</td>
        <td>imagen cartografica</td>
        <td>27 October 2015 17:40</td>
    </tr>

</table>';
@endphp
{{--@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'tree' => $tree, 'action' => 'create' ])--}}

<h3>What happens next...</h3>
<p>The Worksheets you selected for processing have been queued as a series of 'import' tasks on the server.
    They'll be checked for errors and a set of import instructions will be generated for each Worksheet.
    As each Worksheet is processed you'll receive a notification with a link to a page that will display some statistics about the import and ask if you want to proceed.
If you approve, the import will continue and the Vocabulary or Element Set will be sent to the server for importing.
When the import completes, you'll receive another notification of a successful import.</p>
