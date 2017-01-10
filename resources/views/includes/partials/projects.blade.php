@foreach ($logged_in_user->projects as $project)
    <li>{{ \Collective\Html\link_to('projects/'.$project->id, $project->org_name) }}</li>
@endforeach
<li role="separator" class="divider"></li>
<li>{{ \Collective\Html\link_to('projects/create', 'Add New Project') }}</li>

