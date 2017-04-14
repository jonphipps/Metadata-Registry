<!DOCTYPE html>
<html class="no-js" lang="{{ config('app.locale') }}">
@include('frontend.layouts.partials.htmlheader')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1 style="text-align: center">Open Metadata Registry</h1>
        </div>
    </div>
    @yield('content')
</div>
</html>
