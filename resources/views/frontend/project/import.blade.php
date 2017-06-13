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
                    <div id="smartwizard" class="sw-main sw-theme-default">
                        <ul class="nav nav-tabs step-anchor">
                            <li class="active"><a href="#step-1">Step 1<br>
                                    <small>Supply the Spreadsheet URL</small>
                                </a></li>
                            <li><a href="#step-2">Step 2<br>
                                    <small>Choose the Worksheets to Import</small>
                                </a></li>
                            <li><a href="#step-3">Step 3<br>
                                    <small>Verify the Import and approve</small>
                                </a></li>
                            <li><a href="#step-4">Step 4<br>
                                    <small>Process the Import</small>
                                </a></li>
                        </ul>
                        <div class="sw-container tab-content" style="height: 163px;">
                            <div id="step-1" class="step-content" style="display: block;">
                                <h2>Step 1 Supply the Spreadsheet URL</h2>
                                <div>This will be a simple form that takes a Google Worksheets URL and submits it to
                                    the OMR server for reading and gathering worksheets to import.</div>
                                <div>You must have previously shared the Spreadsheet with the OMR importer or made it
                                    a publicly readable spreadsheet.</div>
                                <div>You can record a single default spreadsheet for the project and the form will be
                                    pre-populated with that URL. (this may be much too limiting)
                                </div>
                                <div>You'll also be asked if this is a 'sparse', non-destructive import that only
                                    records changes leaving empty cells and missing rows alone, a 'full' import that
                                    deletes empty cells/statements and missing resource rows, or a 'reset' import that deletes everything (including
                                    history) and starts over as if the resource was entirely new.
                                </div>
                            </div>
                            <div id="step-2" class="step-content">
                                <h2>Step 2 Choose the Worksheets to Import</h2>
                                <div>Here he OMR will display a checkbox list of the worksheets paired with a link to the export
                                    from which they were created. This list will display the original export date and
                                    the date of the last import of that export. We assume that there will be one worksheet
                                    per export and one export per Vocabulary or Element Set. If multiple worksheets/exports
                                    in the set reference the same Vocabulary you'll see a warning, and you'll have to choose
                                    just one to be processed in this import (for now).
                                    Exports/Worksheets that have never
                                    been imported will be highlighted to make it easy to choose just the new ones
                                    from the list. You'll receive a warning if the Vocabulary has been updated by hand or
                                    by another import since either the date of the last import or the date of the original
                                    export.
                                </div>
                                <div>Once you have made your selections, submit the list for processing.</div>
                            </div>
                            <div id="step-3" class="step-content">
                                <h2>Step 3 Verify the Import and approve</h2>
                                <div>The OMR will open each worksheet and check it for significant errors such as:
                                <ul>
                                    <li>Duplicate columns</li>
                                    <li>Unknown columns</li>
                                    <li>Missing required columns</li>
                                </ul>
                                Each of these is a show-stopper and will prevent the worksheet from being imported.
                                </div><div>
                                    It will then compare each worksheet against the original export and create a list of changes
                                    that it intends to make to each Vocabulary: Statements added, Resources added, Statements deleted,
                                    Resources deleted. There will be a warning that resources that have been published
                                    are being deleted and specific approval will be required.
                                    Invalid data errors will be flagged and skipped, including:
                                    <ul>
                                        <li>literals in cells requiring a resource</li>
                                        <li>duplicate per-language prefLabels</li>
                                        <li>duplicate statements</li>
                                        <li>unknown curie prefixes</li>
                                    </ul>
                                    At this point you can either proceed with the import as-is or correct the errors in
                                    your worksheets and go back to step 2.
                                    Submitting the import as-is will instruct the OMR to import what it can, and log what it can't.
                                    A report will be provided after the import with the results for each worksheet.
                                </div>
                            </div>
                            <div id="step-4" class="step-content">
                                <h2>Step 4 Submit the Import for Processing</h2>
                                <div>
                                    You'll be able to watch the progress of each import here if you wish, or click finish
                                    to exit the import process. You'll receive an on-screen notification when each completes
                                    and an email when it's done, with a link to the results.
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection

@section('after_styles')
<link rel="stylesheet" href="{{asset('css/frontend/smart_wizard.css') }}">
<link rel="stylesheet" href="{{asset('css/frontend/smart_wizard_theme_dots.css') }}">
@endsection

@section('after_scripts')
    <script src="{{asset('js/frontend/jquery.smartWizard.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            // Step show event
            $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
                //alert("You are on step "+stepNumber+" now");
                if (stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled');
                } else if (stepPosition === 'final') {
                    $("#next-btn").addClass('disabled');
                } else {
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                .addClass('btn btn-info')
                .on('click', function () {
                    window.location = "{{ route('frontend.crud.projects.show', ['id'=> $project->id]) }}" ;
                });
            var btnCancel = $('<button></button>').text('Cancel')
                .addClass('btn btn-danger')
                .on('click', function () {
                    $('#smartwizard').smartWizard("reset");
                });


            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transitionEffect: 'fade',
                showStepURLhash: true,
                toolbarSettings: {
                    toolbarPosition: 'bottom',
                    toolbarExtraButtons: [btnFinish, btnCancel]
                }
            });


            // External Button Events
            $("#reset-btn").on("click", function () {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });

            $("#prev-btn").on("click", function () {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });

            $("#next-btn").on("click", function () {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });

        });
    </script>
@endsection
