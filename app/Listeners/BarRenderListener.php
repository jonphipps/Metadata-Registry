<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Recca0120\LaravelTracy\Events\BeforeBarRender;

class BarRenderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BeforeBarRender  $event
     * @return void
     */
    public function handle(BeforeBarRender $event)
    {
        if ( ! is_array($_SESSION['_tracy'])) {
            $_SESSION['_tracy'] = [];
        }
    }
}
