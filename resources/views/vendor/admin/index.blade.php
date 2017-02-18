<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" href="/<?php echo env('FAVICON', 'registry_favicon_prod.ico') ?>"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'Open Metadata Registry')">
    <meta name="author" content="@yield('meta_author', 'Jon Phipps')">
@yield('meta')

<!-- Styles -->
@yield('before-styles')

<!-- Tell the browser to be responsive to screen width -->

    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/font-awesome/css/font-awesome.min.css") }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/skins/" . config('admin.skin') .".min.css") }}">

    {!! Admin::css() !!}
    <link rel="stylesheet" href="{{ asset("/packages/admin/nestable/nestable.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/toastr/build/toastr.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/bootstrap3-editable/css/bootstrap-editable.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/google-fonts/fonts.css") }}">
    <link rel="stylesheet" href="{{ asset("/packages/admin/AdminLTE/dist/css/AdminLTE.min.css") }}">

    <!-- REQUIRED JS SCRIPTS -->
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/AdminLTE/dist/js/app.min.js") }}"></script>
    <script src="{{ asset ("/packages/admin/jquery-pjax/jquery.pjax.js") }}"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition {{config('admin.skin')}} {{join(' ', config('admin.layout'))}}">
<div class="wrapper">

    @include('backend.includes.header')

    @include('admin::partials.sidebar')

    <div class="content-wrapper" id="pjax-container">
        @yield('content')
        {!! Admin::script() !!}
    </div>

    @include('admin::partials.footer')

</div>

<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset ("/packages/admin/AdminLTE/plugins/chartjs/Chart.min.js") }}"></script>
<script src="{{ asset ("/packages/admin/nestable/jquery.nestable.js") }}"></script>
<script src="{{ asset ("/packages/admin/toastr/build/toastr.min.js") }}"></script>
<script src="{{ asset ("/packages/admin/bootstrap3-editable/js/bootstrap-editable.min.js") }}"></script>

{!! Admin::js() !!}

<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";

    $.fn.editable.defaults.params = function (params) {
        params._token = '{{ csrf_token() }}';
        params._editable = 1;
        params._method = 'PUT';
        return params;
    };

    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };

    $.pjax.defaults.timeout = 5000;
    $.pjax.defaults.maxCacheLength = 0;
    $(document).pjax('a:not(a[target="_blank"])', {
        container: '#pjax-container'
    });

    $(document).on('submit', 'form[pjax-container]', function(event) {
        $.pjax.submit(event, '#pjax-container')
    });

    $(document).on("pjax:popstate", function() {

        $(document).one("pjax:end", function(event) {
            $(event.target).find("script[data-exec-on-popstate]").each(function() {
                $.globalEval(this.text || this.textContent || this.innerHTML || '');
            });
        });
    });

    $(function(){
        $('.sidebar-menu li:not(.treeview) > a').on('click', function(){
            var $parent = $(this).parent().addClass('active');
            $parent.siblings('.treeview.active').find('> a').trigger('click');
            $parent.siblings().removeClass('active').find('li').removeClass('active');
        });
    });
</script>
@yield('after-scripts')

@include('includes.partials.ga')
</body>
</html>
