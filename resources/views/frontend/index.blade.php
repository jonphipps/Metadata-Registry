@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Welcome to the Open Metadata Registry
                        <strong>BETA</strong>!!</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @include('includes.partials.r-sidebar')
                        <div class="col-md-8 col-md-pull-4">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>What's going on!?</h4>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <p>This is a brand, spanking new beta version of the main
                                                <a href="http://metadataregistry.org">Open Metadata Registry</a> (OMR)
                                                site. Actually it may be a bit alpha, since we're adding services,
                                                improving current services, and occasionally making a mess. Still...
                                                everything works, except
                                                Import. The Export function on this site uses an entirely new and more
                                                sophisticated method of tracking changes to cells and we're still
                                                rewriting the Import function.</p>
                                            <p>If you're familiar with the production OMR, one thing you'll immediately
                                                notice is that this home page looks very different. We haven't decided
                                                what to put on it yet, but we do know that we don't want to replicate
                                                the old one. But making that decision is a low priority at the moment.
                                                You'll also notice that there is more than one style in use and that's
                                                because we're replacing modules gradually.</p>
                                            <p>This site uses an entirely new (and much better!) member authentication
                                                system. If you have an account on the OMR, your account and data also
                                                lives here, but you'll have to reset your password. This will have no
                                                effect on your password on the production OMR. Feel free to set it to
                                                the same password on both sites if you wish.</p>
                                            <h4>This is important...</h4>
                                            <p class="bg-danger">We've ported the OMR data as of mid-December 2016 to this site, but we're
                                                going to periodically do it again, which will destroy anything that you
                                                may create or edit here. We'll do this at random and without
                                                warning, so poke around if you wish, but PLEASE don't count on any data
                                                you may add or edit to persist over time.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                            </div><!--row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--row-->
@endsection
