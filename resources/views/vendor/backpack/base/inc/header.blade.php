<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>
        {{ isset($title) ? ' The Registry! :: ' . $title: 'The Registry!'}}
    </title>
    <link rel="shortcut icon" href="/favicon.ico?v=2"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'Open Metadata Registry')">
    <meta name="author" content="@yield('meta_author', 'Jon Phipps')">
    @yield('meta')

<!-- Styles -->
    @yield('before_styles')

<!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    @langRTL
    {{ Html::style(getRtlCss(mix('css/frontend.css'))) }}
    @else
        {{ Html::style(mix('css/frontend.css')) }}
    @endif
    {{ Html::style(mix('css/all.css')) }}
    @yield('after_styles')

<!-- Scripts -->
    <script>
      window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head_scripts')
</head>
