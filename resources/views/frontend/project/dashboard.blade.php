@extends('backpack::layout')
<?php
/** @var \App\Models\Project $project */
/** @var \App\Http\Controllers\Frontend\Vocabulary\VocabularyCrudController $vocabulary */
/** @var \App\Models\Import $import */
?>
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $project->title }}</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                @include('frontend.partials.panelheader', ['crud' => $vocabulary->crud, 'policy_model' => $project, 'permission' =>'edit' ])<!--panel-heading-->
                                <div class="panel-body">
                                    <ul class="list-unstyled">
                                        @forelse ($project->vocabularies->sortBy('name') as $vocab)
                                            <li>{{ laravel_link_to('vocabularies/'.$vocab->id . '/concepts', $vocab->name) }}</li>
                                        @empty
                                            No Vocabularies defined
                                        @endforelse
                                    </ul>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                            <div class="panel panel-default">
                            @include('frontend.partials.panelheader', ['crud' => $elementset->crud, 'policy_model' => $project, 'permission' =>'edit' ])<!--panel-heading-->
                                <div class="panel-body">
                                    <ul class="list-unstyled">
                                        @forelse ($project->elementsets->sortBy('name') as $elementset)
                                            <li>{{ laravel_link_to('elementsets/'.$elementset->id . '/elements', $elementset->name) }}</li>
                                        @empty
                                            No Element Sets defined
                                        @endforelse
                                    </ul>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Project Detail</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <div class="list-group">Metadata</div>
                                    <dl class="dl-horizontal">
                                        <dt>Created At</dt>
                                        <dd>{{$project->created_at->toFormattedDateString()}}</dd>
                                        <dt>Updated At</dt>
                                        <dd>{{$project->updated_at->toFormattedDateString()}}</dd>
                                    </dl>
                                    <div class="list-group">Description</div>
                                    <dl class="dl-horizontal">
                                        @foreach($project->toArray() as $property => $value)
                                            <dt>{{ title_case(str_replace('_',' ',$property))}}</dt>
                                            <dd>{{ is_array($value) ? 'ARRAY' : $value }}</dd>
                                        @endforeach
                                    </dl>
                                    @can('edit', $project)
                                        <a class="btn btn-default btn-sm pull-right" href="{{route('frontend.crud.projects.edit', ['id' => $project->id])}}" role="button">Edit</a>
                                    @endcan
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-xs-12-->
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Activity</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <p>This will be a running display of project activity</p>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Exports</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <p>This will be a list of Project-level Exports
                                        (maybe)</p>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                @include('frontend.partials.panelheader', ['crud' => $import->crud, 'policy_model' => $project, 'permission' =>'edit' ])<!--panel-heading-->
                                <div class="panel-body">
                                    <ul class="list-unstyled">
                                        @forelse ($project->imports->sortBy('date') as $import)
                                            <li>{{ laravel_link_to('imports/'.$import->id . '/elements', $import->source_file_name) }}</li>
                                        @empty
                                            No Project Imports yet
                                        @endforelse
                                    </ul>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Languages</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <ul class="list-unstyled">
                                        @forelse ($project->languages as $language)
                                            <li>{{ $language }}</li>
                                        @empty
                                            No Languages in use
                                    @endforelse
                                    </ul>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Prefixes</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <p>This will be a list of prefixes in use by this project</p>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Members</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <p>This will be a list of members of this project</p>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Profiles</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <p>This will be a list of Application Profiles used by this project</p>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Maps</h3>
                                </div><!--panel-heading-->
                                <div class="panel-body">
                                    <p>This will be a list of maps maintained by this project</p>
                                </div><!--panel-body-->
                            </div><!--panel-->
                        </div><!--col-md-6-->
                    </div><!--row-->
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection
