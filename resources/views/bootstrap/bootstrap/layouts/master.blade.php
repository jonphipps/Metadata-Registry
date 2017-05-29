<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('page-title', '')</title>
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body style="padding-top: 70px; margin-bottom: 70px;">
        <div class="container">
            <header>
                @include('wizard::bootstrap.layouts.menu-top')
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @include('wizard::bootstrap.layouts.messages')
                    </div>
                    <div class="row">
                        <h1 id="content-title">@yield('content-title')</h1>
                        <hr />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="breadcumbs">
                        @yield('breadcrumbs')
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>