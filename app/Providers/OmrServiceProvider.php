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
        'Encore\Admin\Commands\MakeCommand',
        'Encore\Admin\Commands\MenuCommand',
        'Encore\Admin\Commands\InstallCommand',
        'Encore\Admin\Commands\UninstallCommand',
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

        Admin::registerAuthRoutes();

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


}
