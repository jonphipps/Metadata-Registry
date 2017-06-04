<!-- jqxTree -->
{{-- ########################################## --}}
{{-- WARNING!!!! This has not been tested thoroughly. In particular the data source is just an experiment. --}}
{{-- ########################################## --}}
<input type="hidden" name="{{$field['name']}}" id="{{$field['name']}}">
<div @include('crud::inc.field_wrapper_attributes') >
    <div><label>{!! $field['label'] !!}</label></div>
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div style='float: left;'>
            <div id='jqxTree-{!! $field["name"] !!}' style='visibility: hidden; float: left; margin-left: 20px;'>
                {!! $tree !!}
            </div>
        </div>
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
    <!-- include jqxTree css-->
    <link href="{{ asset('vendor/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet" type="text/css"/>
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
    <!-- include jqxTree js-->
    <script src="{{ asset('vendor/jqwidgets/jqxcore.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxbuttons.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxscrollbar.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxpanel.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxtree.js') }}"></script>
    <script src="{{ asset('vendor/jqwidgets/jqxcheckbox.js') }}"></script>
    <script>
      $(document).ready(function () {
        // create jqxTree
        var $jqxTree = $('#jqxTree-{!! $field["name"] !!}');
        $jqxTree.jqxTree({height: '400px', hasThreeStates: true, checkboxes: true, width: '330px'});
        $jqxTree.css('visibility', 'visible');
        $jqxTree.jqxTree('selectItem', $("#home")[0]);
           });
      $("form").submit(function (event) {
        $('input[name="{{$field['name']}}"]').val(JSON.stringify($('#jqxTree-{!! $field["name"] !!}').jqxTree('getCheckedItems')));
      });
    </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}{{-- ########################################## --}}
