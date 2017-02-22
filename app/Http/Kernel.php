<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel
 *
 * @package App\Http
 */
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LocaleMiddleware::class,
        ],

        'symfony' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\LocaleMiddleware::class,
        ],

        'admin' => [
            'auth',
            'admin.pjax',
            'admin.log',
            'admin.bootstrap',
            'timeout',
        ],

        'backend' => [
            'auth',
            'access.routeNeedsPermission:view-backend',
            'timeout',
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                        => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'                  => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'                    => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'                         => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'                       => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'                    => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'timeout'                     => \App\Http\Middleware\SessionTimeout::class,
        'passthru'                    => \App\Http\Middleware\PassThrough::class,
        /**
         * Encore admin Middleware
         */
        'admin.auth'                  => \Encore\Admin\Middleware\Authenticate::class,
        'admin.pjax'                  => \App\Http\Middleware\PjaxMiddleware::class,
        'admin.log'                   => \App\Http\Middleware\OperationLog::class,
        'admin.permission'            => \Encore\Admin\Middleware\PermissionMiddleware::class,
        'admin.bootstrap'             => \Encore\Admin\Middleware\BootstrapMiddleware::class,
        /**
         * Access Middleware
         */
        'access.routeNeedsRole'       => \App\Http\Middleware\RouteNeedsRole::class,
        'access.routeNeedsPermission' => \App\Http\Middleware\RouteNeedsPermission::class,

        'admin.pjax' => \Encore\Admin\Middleware\PjaxMiddleware::class,

    ];
}
