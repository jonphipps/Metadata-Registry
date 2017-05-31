@extends('backpack::layout')<?php /** @var \App\Models\Project $project */ ?>
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
                        @yield('step')
                    </div>
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection
