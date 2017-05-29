@extends('wizard::bootstrap.flows.layouts.master')


@section('page-title')
    {{ Translate::recursive('wizard::flows.exampleFlow.firstStep.title') }}
@endsection


@section('content-title')
    {{ Translate::recursive('wizard::flows.exampleFlow.firstStep.title') }}
@endsection


@section('content')

    {!! Form::open(array('route' => array('flows.step', $flow->id, 'first-step'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}

        <div class="row">
            <div class="well well-large col-lg-12">
                First flow step
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" class="btn btn-lg btn-primary">{{ Translate::recursive('wizard::flows.next') }}</button>
                </div>
            </div>
        </div>

    {!! Form::close() !!}

@endsection