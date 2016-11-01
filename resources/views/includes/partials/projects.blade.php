<ul class="dropdown-menu" role="menu">
        @foreach ($logged_in_user->Projects as $project)
                        <li>{{ \Collective\Html\link_to('projects/'.$project->id.'.html', $project->org_name) }}</li>
        @endforeach
</ul>
