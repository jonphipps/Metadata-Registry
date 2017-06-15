<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('vendor.backpack.base.inc.header')
<body id="app-layout" class="hold-transition {{ config('backpack.base.skin') }} sidebar-mini ">
    @include('includes.partials.logged-in-as')
<div id="app">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- =============================================== -->
    @include('backend.includes.header')
    @include('backpack::inc.sidebar')
    <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        @include('includes.partials.messages')
        <!-- Content Header (Page header) -->
        @yield('header')

        <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <footer class="main-footer">
            @if (config('backpack.base.show_powered_by'))
                <div class="pull-right hidden-xs">
                    {{ trans('backpack::base.powered_by') }} <a target="_blank" href="http://laravelbackpack.com">Laravel
                        BackPack</a>
                </div>
            @endif
            {{ trans('backpack::base.handcrafted_by') }}
            <a target="_blank" href="{{ config('backpack.base.developer_link') }}">{{ config('backpack.base.developer_name') }}</a>.
        </footer>
    </div><!-- /.content-wrapper -->
</div><!--#app-->
@yield('before_scripts')
<script type="text/javascript">
  // Set active state on menu element
  var current_url = "{{ Request::url() }}";
</script>
{!! Html::script(mix('js/manifest.js')) !!}
{!! Html::script(mix('js/vendor.js')) !!}
{!! Html::script(mix('js/frontend.js')) !!}

@include('backpack::inc.alerts')

@yield('after_scripts')

@include('includes.partials.ga')

<!-- JavaScripts -->
</body>
</html>
