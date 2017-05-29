@extends('bootstrap.layouts.master')


@section('page-title')
    {{ Translate::recursive('flows.gsimport.spreadsheet.title') }}
@endsection


@section('content-title')
    {{ Translate::recursive('flows.gsimport.spreadsheet.title') }}
@endsection


@section('step')
    <div>
        <h2>Step 1 Supply the Spreadsheet URL</h2>
        <div>This will be a simple form that takes a Google Worksheets URL and submits it to
            the OMR server for reading and gathering worksheets to import.
        </div>
        <div>You must have previously shared the Spreadsheet with the OMR importer or made it
            a publicly readable spreadsheet.
        </div>
        <div>You can record a single default spreadsheet for the project and the form will be
            pre-populated with that URL. (this may be much too limiting)
        </div>
        <div>You'll also be asked if this is a 'sparse', non-destructive import that only
            records changes leaving empty cells and missing rows alone, a 'full' import that
            deletes empty cells/statements and missing resource rows, or a 'reset' import that
            deletes everything (including
            history) and starts over as if the resource was entirely new.
        </div>
    </div>

    {!! Form::open(array('route' => array('frontend.project.import.process', $project, '1', 'spreadsheet'), 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form')) !!}


        <div class="row">
            <div class="col-lg-12">
                <div class="pull-right">
                    <button type="submit" class="btn btn-lg btn-primary">{{ Translate::recursive('wizard::flows.next') }}</button>
                </div>
            </div>
        </div>

    {!! Form::close() !!}

@endsection
