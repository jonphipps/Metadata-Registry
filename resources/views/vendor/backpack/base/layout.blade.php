<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>
        {{ isset($title) ? ' The Registry! :: ' . $title: 'The Registry!'}}
    </title>
    <link rel="icon" href="/<?php echo env('FAVICON', 'registry_favicon_prod.ico') ?>"/>
    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'Open Metadata Registry')">
    <meta name="author" content="@yield('meta_author', 'Jon Phipps')">
    @yield('meta')

<!-- Styles -->
    <script src="https://use.fontawesome.com/f27a8c3a13.js"></script>
    @yield('before_styles')

<!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    @langRTL
    {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
    @else
        {{ Html::style(mix('css/frontend.css')) }}
    @endif
    {{ Html::style(mix('css/all.css')) }}
<!-- Bootstrap 3.3.5
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
 -->
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load.
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-blue.min.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/pace/pace.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">
 -->
<!-- BackPack Base CSS
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}">
    -->
    @yield('after_styles')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head_scripts')
</head>
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

<!-- jQuery 2.2.0
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{ asset('vendor/adminlte') }}/plugins/jQuery/jQuery-2.2.0.min.js"><\/script>')</script>
-->
<!-- Bootstrap 3.3.5
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/fastclick/fastclick.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>
    -->
@include('backpack::inc.alerts')

@yield('after_scripts')

@include('includes.partials.ga')

<!-- JavaScripts -->
</body>
</html>
