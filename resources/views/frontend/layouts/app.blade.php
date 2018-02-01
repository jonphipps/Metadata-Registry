<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="/{!! config('app.fav_icon', 'registry_favicon_prod.ico') !!}"/>

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Open Metadata Registry')">
        <meta name="author" content="@yield('meta_author', 'Jon Phipps')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')
        {{ Html::style('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
        @else
            {{ Html::style(mix('css/frontend.css')) }}
        @endif
        {{ Html::style(mix('css/all.css')) }}

    @yield('after-styles')

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]); !!};
        </script>
    </head>
    <body id="app-layout">
        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('backend.includes.header')

            <div class="container">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!--#app-->

        <!-- Scripts -->
        @yield('before-scripts')
        <script type="text/javascript">
          // Set active state on menu element
          var current_url = "{{ Request::url() }}";
        </script>
        {!! Html::script(mix('js/manifest.js')) !!}
        {!! Html::script(mix('js/vendor.js')) !!}
        {!! Html::script(mix('js/frontend.js')) !!}
        @yield('after-scripts')

        @include('includes.partials.ga')
    </body>
</html>
