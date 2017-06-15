<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('vendor.backpack.base.inc.header')
<body style="background-color: aliceblue;">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div style="margin-top: 10%;margin-bottom: 2em;">
                <h1 style="text-align: center;font-weight: bold;">
                    <a href="/" style=" cursor: pointer;">Open Metadata Registry</a>
                </h1>
            </div>
        </div>
    </div>
    @include('includes.partials.messages')
    @yield('content')
</div>
</body>
</html>
