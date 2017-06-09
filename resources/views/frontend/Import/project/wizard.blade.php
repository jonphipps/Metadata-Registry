@extends('backpack::layout')<?php /** @var \App\Models\Project $project
 * @var Backpack\CRUD\CrudPanel $crud
 * @var Smajti1\Laravel\Wizard  $wizard
 */ ?>
@section('header')
    <section class="content-header">
        <h1>
            {{ trans('backpack::crud.add') }} <span>Google Sheets Import for {{$project->title}}</span>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('frontend.user.dashboard' ) }}">{{ trans('backpack::base.dashboard') }}</a>
            </li>
            <li>
                <a href="{{ route('frontend.project.show', ['id' => $project->id] ) }}">Project</a>
            </li>
            <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
            <li class="active">{{ trans('backpack::crud.add') }}</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <ol>
            @foreach($wizard->all() as $key => $_step)
                <li>
                    @if($step->index === $_step->index)
                        <strong>{{ $_step::$label }}</strong>
                    @elseif($step->index > $_step->index)
                        <a href="{{ route('frontend.project.import', ['project' => $project->id, 'step'=>$_step::$slug]) }}">{{ $_step::$label }}</a>
                    @else
                        {{ $_step::$label }}
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Default box -->
            @if ($crud->hasAccess('list'))
                <a href="{{ url($crud->route) }}"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }}
                    <span class="text-lowercase">{{ $crud->entity_name_plural }}</span></a><br><br>
            @endif

            @include('crud::inc.grouped_errors')

            {!! Form::open(array('url' => route('frontend.project.import.post', ['project' => $project->id,'step' => $step::$slug]), 'method' => 'post', 'files'=>$crud->hasUploadFields('create'))) !!}
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $step::$label}}</h3>
                </div>
                <div class="box-body row">
                    @include($step::$view, compact('step', 'errors'))
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <nav class="navbar btn-toolbar sw-toolbar sw-toolbar-bottom">
                        <div class="btn-group navbar-btn sw-btn-group-extra pull-right" role="group">
                            @unless($wizard->hasNext())
                                <button class="btn btn-info">Finish</button>
                            @endunless
                            <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="fa fa-ban"></span>
                                &nbsp;{{ trans('backpack::crud.cancel') }}</a>
                        </div>
                        <div class="btn-group navbar-btn sw-btn-group pull-right" role="group">
                            <a class="btn btn-default sw-btn-prev @unless($wizard->hasPrev()) disabled @endunless" href="{{ route('frontend.project.import', ['project' => $project->id,'step' => $wizard->prevSlug()]) }}" type="button">Previous</a>
                            @if ($wizard->hasNext())
                                <button class="btn btn-default sw-btn-next">Next</button>
                            @endif
                        </div>
                    </nav>
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
            {!! Form::close() !!}
        </div>
    </div>

@endsection
