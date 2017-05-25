@extends('backpack::layout')<?php /** @var \App\Models\Project $project */ ?>
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $project->title }}</h1>
                </div>
                <div class="panel-body">
                    <div id="smartwizard" class="sw-main sw-theme-default">
                        <ul class="nav nav-tabs step-anchor">
                            <li class="active"><a href="#step-1">Step 1<br>
                                    <small>This is step description</small>
                                </a></li>
                            <li class=""><a href="#step-2">Step 2<br>
                                    <small>This is step description</small>
                                </a></li>
                            <li><a href="#step-3">Step 3<br>
                                    <small>This is step description</small>
                                </a></li>
                            <li><a href="#step-4">Step 4<br>
                                    <small>This is step description</small>
                                </a></li>
                        </ul>
                        <nav class="navbar btn-toolbar sw-toolbar sw-toolbar-top">
                            <div class="btn-group navbar-btn sw-btn-group-extra pull-right" role="group">
                                <button class="btn btn-info">Finish</button>
                                <button class="btn btn-danger">Cancel</button>
                            </div>
                            <div class="btn-group navbar-btn sw-btn-group pull-right" role="group">
                                <button class="btn btn-default sw-btn-prev disabled" type="button">Previous</button>
                                <button class="btn btn-default sw-btn-next" type="button">Next</button>
                            </div>
                        </nav>
                        <div class="sw-container tab-content" style="height: 163px;">
                            <div id="step-1" class="step-content" style="display: block;">
                                <h2>Step 1 Content</h2>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <div id="step-2" class="step-content" style="display: none;">
                                <h2>Step 2 Content</h2>
                                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                    the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                    with desktop publishing software like Aldus PageMaker including versions of Lorem
                                    Ipsum.
                                </div>
                            </div>
                            <div id="step-3" class="step-content" style="display: none;">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <div id="step-4" class="step-content" style="display: none;">
                                <h2>Step 4 Content</h2>
                                <div class="panel panel-default">
                                    <div class="panel-heading">My Details</div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Name:</th>
                                            <td>Tim Smith</td>
                                        </tr>
                                        <tr>
                                            <th>Email:</th>
                                            <td>example@example.com</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <nav class="navbar btn-toolbar sw-toolbar sw-toolbar-bottom">
                            <div class="btn-group navbar-btn sw-btn-group-extra pull-right" role="group">
                                <button class="btn btn-info">Finish</button>
                                <button class="btn btn-danger">Cancel</button>
                            </div>
                            <div class="btn-group navbar-btn sw-btn-group pull-right" role="group">
                                <button class="btn btn-default sw-btn-prev disabled" type="button">Previous</button>
                                <button class="btn btn-default sw-btn-next" type="button">Next</button>
                            </div>
                        </nav>
                    </div>               </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection

@section('after_styles')
<link rel="stylesheet" href="{{asset('css/frontend/smart_wizard.css') }}">
@endsection

@section('after_scripts')
    <script src="{{asset('js/frontend/jquery.smartWizard.min.js') }}"></script>
@endsection
