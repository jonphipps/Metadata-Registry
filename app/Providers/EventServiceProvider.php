<?php

namespace App\Providers;

use App\Listeners\BarRenderListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Recca0120\LaravelTracy\Events\BeforeBarRender;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //laravel Tracy
        BeforeBarRender::class => [BarRenderListener::class,
        ],
    ];
    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        /*
         * Frontend Subscribers
         */
        \App\Listeners\ImportEventListener::class,

        /*
         * Auth Subscribers
         */
        \App\Listeners\Frontend\Auth\UserEventListener::class,

        /*
         * Backend Subscribers
         */

        /*
         * Access Subscribers
         */
        \App\Listeners\Backend\Access\User\UserEventListener::class,
        \App\Listeners\Backend\Access\Role\RoleEventListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
