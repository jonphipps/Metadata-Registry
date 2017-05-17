@foreach ($logged_in_user->projects as $project)
    <li>{{ laravel_link_to('projects/'.$project->id, $project->label) }}</li>
@endforeach
<li role="separator" class="divider"></li>
<li>{{ laravel_link_to('projects/create', 'Add New Project') }}</li>

