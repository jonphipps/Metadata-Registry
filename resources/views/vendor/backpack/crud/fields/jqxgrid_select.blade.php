<!-- jqxGrid -->
<input type="hidden" name="selected_{{$field['name']}}" id="selected_{{$field['name']}}">
<div @include('crud::inc.field_wrapper_attributes') >
    <div><label>{!! $field['label'] !!}</label></div>
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div id="jqxGrid-{!! $field['name'] !!}"></div>
    </div>
</div>
<div>
    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
    <!-- include jqxGrid css-->
    <link href="{{ asset('vendor/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet" type="text/css"/>
    @endpush
    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
    <!-- include jqxGrid js-->
    <script src="{{ asset('vendor/jqwidgets/jqxcore.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxbuttons.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxscrollbar.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxmenu.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxgrid.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxgrid.selection.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxdata.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxgrid.sort.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxgrid.filter.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxgrid.pager.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxpanel.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxcheckbox.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxlistbox.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxdropdownlist.js') }}"></script>
    @endpush
@endif
@push('crud_fields_scripts')
<script>
      $(document).ready(function () {
        var jqxGrid = $('#jqxGrid-{!! $field["name"] !!}');
        var selectedRows = {!! $selected ?? json_encode([]) !!};

        var source =
          {
            // prepare the data. This should be json array of rows
            localdata: {!! $data !!},
            datatype: "array"
          };
        var dataAdapter = new $.jqx.dataAdapter(source, {
          downloadComplete: function (data, status, xhr) {
          },
          loadComplete: function (data) {
          },
          loadError: function (xhr, status, error) {
          }
        });

        jqxGrid.jqxGrid( {!! $props !!});
{{-- $props should be a properties object. For instance...
{
    width: 700,
    autoheight: true,
    source: dataAdapter,
    sortable: true,
    filterable: true,
    pageable: true,
    ready: function () {
      // called when the Grid is loaded. Call methods or set properties here.
    },
    selectionmode: 'checkbox',
    altrows: true,
    columns: [
      {text: 'First Name', datafield: 'firstname', width: 100}, //must include a default width if using autoresize
      {text: 'Last Name', datafield: 'lastname', width: 100},
      {text: 'Product', datafield: 'productname', width: 180},
      {text: 'Quantity', datafield: 'quantity', width: 80, cellsalign: 'right'},
      {text: 'Unit Price', datafield: 'price', width: 90, cellsalign: 'right', cellsformat: 'c2'},
      {text: 'Total', datafield: 'total', width: 100, cellsalign: 'right', cellsformat: 'c2'}
    ]
  }
--}}
jqxGrid.jqxGrid('autoresizecolumns');
//resize the grid
var gridWidth = 0;
var startCol = 0;
if(jqxGrid.jqxGrid('selectionmode') === 'checkbox') {
  gridWidth = 30;
  startCol = 2;
}
var columns = jqxGrid.jqxGrid('columns');
for (var i = startCol; i < columns.length(); i++) {
  gridWidth += columns.records[i].width;
}
jqxGrid.jqxGrid({width: gridWidth});

//select the rows
var gridRows = jqxGrid.jqxGrid('getrows');
//debugger;
for (var i = 0; i < selectedRows.length; i++) {
  for (var x = 0; x < gridRows.length; x++) {
    var rowId = jqxGrid.jqxGrid('getrowdatabyid', x).id;
    if (rowId === selectedRows[i]) {
      jqxGrid.jqxGrid('selectrow', x);
    }
  }
}

});

$("form").submit(function (event) {
//debugger;
var jqxGrid = $('#jqxGrid-{!! $field["name"] !!}');
var selectedIds = [];
var selectedRowIndexes = jqxGrid.jqxGrid('getselectedrowindexes');
for (var i = 0; i < selectedRowIndexes.length; i++) {
  selectedIds[i] = jqxGrid.jqxGrid('getrowdatabyid', selectedRowIndexes[i]).id;
}
$('input[name="selected_{{$field['name']}}"]').val(JSON.stringify(selectedIds));
});
</script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
