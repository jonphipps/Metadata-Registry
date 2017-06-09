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
@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'tree' => $tree, 'action' => 'create' ])

