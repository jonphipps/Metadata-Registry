<?php

namespace App\Listeners;

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
        if (isset($_SESSION['_tracy']) && ! is_array($_SESSION['_tracy'])) {
            $_SESSION['_tracy'] = [];
        }
    }
}
