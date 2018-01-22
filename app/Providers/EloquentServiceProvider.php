<?php

namespace App\Providers;

use App\Models\Access\User\User;
use App\Models\Elementset;
use App\Models\Vocabulary;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'User'       => User::class,
            'Vocabulary' => Vocabulary::class,
            'Elementset' => Elementset::class,
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
