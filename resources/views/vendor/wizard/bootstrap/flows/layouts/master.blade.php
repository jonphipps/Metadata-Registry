@extends('wizard::bootstrap.layouts.master')


@section('breadcrumbs')

    @if( !empty($breadcrumbs) )
        <ol class="breadcrumb">
        @foreach( $breadcrumbs as $step )
            @if( !$step->isOptional || ( $step->isOptional && $step->class == 'active' ) )
                @if( empty($step->class) )
                    <li class="{{ $step->class }}">{!! HTML::linkRoute('flows.step', $step->title, $step->getParameters) !!}</li>
                @else
                    <li>{{ $step->title }}</li>
                @endif
            @endif
        @endforeach
        </ol>
    @endif

@endsection