<?php

namespace App\Providers;

use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class OmrServiceProvider extends ServiceProvider
{
  /**
   * @var array
   */
  protected $commands = [
        \Encore\Admin\Commands\MakeCommand::class,
        \Encore\Admin\Commands\MenuCommand::class,
        \Encore\Admin\Commands\InstallCommand::class,
        \Encore\Admin\Commands\UninstallCommand::class,
  ];

  /**
   * The application's route middleware.
   *
   * @var array
   */
  protected $routeMiddleware = [
        //'admin.auth'       => \Encore\Admin\Middleware\Authenticate::class,
        'admin.pjax'        => \Encore\Admin\Middleware\PjaxMiddleware::class,
        'admin.log'        => \App\Http\Middleware\OperationLog::class,
        //'admin.permission' => \Encore\Admin\Middleware\PermissionMiddleware::class,
        'admin.bootstrap'   => \Encore\Admin\Middleware\BootstrapMiddleware::class,
  ];

  /**
   * The application's route middleware groups.
   *
   * @var array
   */
  protected $middlewareGroups = [
      'admin' => [
//            'admin.auth',
            'admin.pjax',
            'admin.log',
            'admin.bootstrap',
      ],
  ];


  /**
   * Boot the service provider.
   *
   * @return void
   */
  public function boot()
  {
        $this->loadViewsFrom(base_path('vendor/encore/laravel-admin/views'), 'admin');
        $this->loadTranslationsFrom(base_path('resources/lang/'), 'admin');

    //Admin::registerAuthRoutes();

    if (file_exists($routes = admin_path('routes.php'))) {
      require $routes;
    }
  }


  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->booting(function () {
      $loader = AliasLoader::getInstance();

      $loader->alias('Admin', \Encore\Admin\Facades\Admin::class);

            // if (is_null(config('auth.guards.admin'))) {
            //     $this->setupAuth();
            // }
    });

        $this->registerRouteMiddleware();

        $this->commands($this->commands);
  }


  /**
   * Setup auth configuration.
   *
   * @return void
   */
  protected function setupAuth()
  {
    config([
        'auth.guards.admin.driver'    => 'session',
        'auth.guards.admin.provider'  => 'admin',
        'auth.providers.admin.driver' => 'eloquent',
        'auth.providers.admin.model'  => \Encore\Admin\Auth\Database\Administrator::class,
    ]);
  }

  /**
   * Register the route middleware.
   *
   * @return void
   */
  protected function registerRouteMiddleware()
  {
    // register route middleware.
    foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
    }

    // register middleware group.
    foreach ($this->middlewareGroups as $key => $middleware) {
      app('router')->middlewareGroup($key, $middleware);
    }
  }
}
