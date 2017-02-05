<?php

namespace App\Providers;

use App\Models\ElementSet;
use App\Models\Project;
use App\Models\Vocabulary;
use App\Policies\ElementSetPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\VocabularyPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      'App\Model'       => 'App\Policies\ModelPolicy',
      Project::class    => ProjectPolicy::class,
      Vocabulary::class => VocabularyPolicy::class,
      ElementSet::class => ElementSetPolicy::class,
      /** Module policy mapper */
      'agent'           => ProjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
