@if ($crud->hasAccess('update_production'))
	<a href="{{ url($crud->route.'/update_production') }}" class="btn btn-primary" data-style="zoom-in"><i class="fa fa-database"></i> {{ trans('buttons.general.update_production') }}</a>
@endif
