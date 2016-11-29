<ul class="dropdown-menu" role="menu">
        @foreach ($logged_in_user->Projects as $project)
                        <li>{{ \Collective\Html\link_to('projects/'.$project->id, $project->org_name) }}</li>
        @endforeach
            <li>{{ \Collective\Html\link_to('projects/create', 'New Project') }}</li>
</ul>
