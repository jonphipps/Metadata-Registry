@extends('frontend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('navs.frontend.dashboard') }}</div>

                <div class="panel-body">
                    <div class="row">
                        @include('includes.partials.r-sidebar')
                        <div class="col-md-8 col-md-pull-4">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>My Projects</h4>
                                        </div><!--panel-heading-->
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                @forelse ($logged_in_user->projects->sortBy('org_name') as $project)
                                                    <li>{{ laravel_link_to('projects/'.$project->id, $project->org_name) }}</li>
                                                @empty
                                                    Start by Adding a Project...
                                                @endforelse
                                            </ul>
                                            <a class="btn btn-default btn-sm pull-right" href="projects/create" role="button">Add New Project</a>
                                        </div><!--panel-body-->
                                    </div><!--panel-->
                                </div><!--col-xs-12-->
                            </div><!--row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4>Vocabularies I Maintain</h4>
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
                                            <h4>Element Sets I Maintain</h4>
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
