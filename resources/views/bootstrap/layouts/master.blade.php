@extends('backpack::layout')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $project->title }}</h1>
                </div>
                <div class="panel-body">
                    <div class="panel-heading">
                        <h2>Import from Google Spreadsheet</h2>
                    </div>
                    <div>
                        @include('wizard::bootstrap.layouts.messages')
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="breadcumbs">
                                @if( !empty($breadcrumbs) )
                                    <ol class="breadcrumb">
                                        @foreach( $breadcrumbs as $step )
                                            @if( !$step->isOptional || ( $step->isOptional && $step->class === 'active' ) )
                                                @if( empty($step->class) )
                                                    <li class="{{ $step->class }}">{!! HTML::linkRoute('flows.step', $step->title, $step->getParameters) !!}</li>
                                                @else
                                                    <li>{{ $step->title }}</li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ol>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="content">
                                @yield('step')
                            </div>
                        </div>
                    </div>
                </div><!-- panel -->
            </div>
        </div><!-- col-xs-12 -->
    </div><!-- row -->
@endsection
