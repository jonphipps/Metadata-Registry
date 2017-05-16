<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->
        <ul class="nav navbar-nav">
            @if ($logged_in_user)
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ trans('navs.frontend.projects') }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        @include('includes.partials.projects')
                    </ul>
                </li>
            @endif
        </ul>
        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->
        @if ($logged_in_user)
            <li>{{ laravel_link_to_route('frontend.user.dashboard', trans('navs.frontend.dashboard'), [], ['class' => active_class(Active::checkRoute('frontend.user.dashboard')) ]) }}</li>
        @endif

        @if (! $logged_in_user)
            <li>{{ laravel_link_to_route('frontend.auth.login', trans('navs.frontend.login'), [], ['class' => active_class(Active::checkRoute('frontend.auth.login')) ]) }}</li>

            @if (config('access.users.registration'))
                <li>{{ laravel_link_to_route('frontend.auth.register', trans('navs.frontend.register'), [], ['class' => active_class(Active::checkRoute('frontend.auth.register')) ]) }}</li>
            @endif
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ $logged_in_user->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    @permission('view-backend')
                    <li>{{ laravel_link_to_route('admin.dashboard', trans('navs.frontend.user.administration')) }}</li>
                    @endauth
                    <li>{{ laravel_link_to_route('frontend.user.account', trans('navs.frontend.user.account'), [], ['class' => active_class(Active::checkRoute('frontend.user.account')) ]) }}</li>
                    <li>{{ laravel_link_to_route('frontend.auth.logout', trans('navs.general.logout')) }}</li>
                </ul>
            </li>
    @endif


    <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
