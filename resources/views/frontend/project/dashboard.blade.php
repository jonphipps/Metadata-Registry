@extends('frontend.layouts.app')
<?php /** @var \App\Models\Project $project */ ?>
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $project->org_name }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        @include('includes.partials.r-sidebar')
                        <div class="col-md-8 col-md-pull-4">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Project Detail</h4>
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
                                                <dt>{{$property}}</dt>
                                                <dd>{{$value}}</dd>
                                                @endforeach
                                            </dl>
                                            @can('edit', $project)
                                            <a class="btn btn-default btn-sm pull-right" href="projects/{{$project->id}}/edit" role="button">Edit</a>
                                            @endcan
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                            </div><!--row-->
                            <div class="row">
                                <div class="col-xs-12 ">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Project Vocabularies</h4>
                                        </div><!--panel-heading-->
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
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Project Element Sets</h4>
                                        </div><!--panel-heading-->
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
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Profiles</h4>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <p>This will be a list of Application Profiles used by this project
                                                (maybe)</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Members</h4>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <p>This will be a list of members of this project
                                                (maybe). Languages in use is another possibility. Or maps.</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                            </div><!--row-->
                        </div><!--col-md-8-->
                    </div><!--row-->
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection
