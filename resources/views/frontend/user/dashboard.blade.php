@extends('backpack::layout')


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>{{ trans('navs.frontend.dashboard') }}</h1></div>

                <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>My Projects</h3>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                @forelse ($logged_in_user->projects->sortBy('title') as $project)
                                                    <li>{{ laravel_link_to('projects/'.$project->id, $project->title) }}</li>
                                                @empty
                                                    Start by Adding a Project...
                                                @endforelse
                                            </ul>
                                            <a class="btn btn-primary btn-sm pull-right" href="{{ route('frontend.crud.projects.create') }}" role="button">Add New Project</a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Activity</h3>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <p>This will be a running display of my activity</p>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                            </div><!--row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>Vocabularies I Maintain</h3>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                @forelse ($logged_in_user->vocabularies->sortBy('name') as $vocab)
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
                                        <div class="panel-heading">
                                            <h3>Element Sets I Maintain</h3>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                @forelse ($logged_in_user->elementsets->sortBy('name') as $elementset)
                                                    <li>{{ laravel_link_to('elementsets/'.$elementset->id . '/elements', $elementset->name) }}</li>
                                                @empty
                                                    No Element Sets defined
                                                @endforelse
                                            </ul>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-md-6-->
                            </div><!--row-->
                </div><!--panel body-->
            </div><!-- panel -->
        </div><!-- col-md-10 -->
    </div><!-- row -->
@endsection
