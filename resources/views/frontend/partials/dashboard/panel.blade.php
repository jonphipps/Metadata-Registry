<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="pull-left" style="margin-top: 8px; margin-bottom: 6px">{{$entity->crud->entity_name_plural}}</h3>
            @can('edit', $project)
                @include('frontend.partials.panel.headerbutton', ['crud' => $entity->crud ])
            @endcan
        </div>
        <div class="panel-body">
            <ul class="list-unstyled">
                @forelse ($project->$entity->sortBy('name') as $item)
                    <li>{{ laravel_link_to('elementsets/'.$item->id . '/elements', $item->name) }}</li>
                @empty
                    No {{$entity->crud->entity_name_plural}} defined
                @endforelse
            </ul>
        </div><!--panel-body-->
    </div><!--panel-->
</div><!--col-md-6-->
