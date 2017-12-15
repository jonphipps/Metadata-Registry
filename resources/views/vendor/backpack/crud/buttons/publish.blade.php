@if ($crud->hasAccess('publish'))
	<a href="{{ url($crud->route."/{$entry->id}/publish") }}" class="btn btn-xs btn-default" ><i class="fa fa-exchange"></i> {{ trans('buttons.general.publish') }} </a>
@endif
