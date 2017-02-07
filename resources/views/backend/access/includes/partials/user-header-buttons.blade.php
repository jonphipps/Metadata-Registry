<div class="pull-right mb-10 hidden-sm hidden-xs">
    {{  laravel_link_to_route('admin.access.user.index', trans('menus.backend.access.users.all'), [], ['class' => 'btn btn-primary btn-xs']) }}
    {{  laravel_link_to_route('admin.access.user.create', trans('menus.backend.access.users.create'), [], ['class' => 'btn btn-success btn-xs']) }}
    {{  laravel_link_to_route('admin.access.user.deactivated', trans('menus.backend.access.users.deactivated'), [], ['class' => 'btn btn-warning btn-xs']) }}
    {{  laravel_link_to_route('admin.access.user.deleted', trans('menus.backend.access.users.deleted'), [], ['class' => 'btn btn-danger btn-xs']) }}
</div><!--pull right-->

<div class="pull-right mb-10 hidden-lg hidden-md">
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            {{ trans('menus.backend.access.users.main') }} <span class="caret"></span>
        </button>

        <ul class="dropdown-menu" role="menu">
            <li>{{  laravel_link_to_route('admin.access.user.index', trans('menus.backend.access.users.all')) }}</li>
            <li>{{  laravel_link_to_route('admin.access.user.create', trans('menus.backend.access.users.create')) }}</li>
            <li class="divider"></li>
            <li>{{  laravel_link_to_route('admin.access.user.deactivated', trans('menus.backend.access.users.deactivated')) }}</li>
            <li>{{  laravel_link_to_route('admin.access.user.deleted', trans('menus.backend.access.users.deleted')) }}</li>
        </ul>
    </div><!--btn group-->
</div><!--pull right-->

<div class="clearfix"></div>
