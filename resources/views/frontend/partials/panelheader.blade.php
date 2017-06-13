<div class="panel-heading clearfix">
    <h3 class="pull-left" style="margin-top: 8px; margin-bottom: 6px">{{$crud->entity_name_plural}}</h3>
    @can($permission, $policy_model)
        <div class="btn-group pull-right">
            <a href="{{ url($crud->route.'/create') }}" class="btn btn-success ladda-button btn-small" data-style="zoom-in" style="margin-top: 3px"><span class="ladda-label"><i class="fa fa-plus"></i> {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}</span></a>
        </div>
    @endcan
</div>
