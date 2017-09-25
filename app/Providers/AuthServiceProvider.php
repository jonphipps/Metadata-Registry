<?php

namespace App\Providers;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\Elementset;
use App\Models\Import;
use App\Models\Project;
use App\Models\Vocabulary;
use App\Policies\ConceptAttributePolicy;
use App\Policies\ConceptPolicy;
use App\Policies\ElementAttributePolicy;
use App\Policies\ElementPolicy;
use App\Policies\ElementSetPolicy;
use App\Policies\ImportPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\VocabularyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
  /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model'             => 'App\Policies\ModelPolicy',
        Concept::class          => ConceptPolicy::class,
        ConceptAttribute::class => ConceptAttributePolicy::class,
        Element::class          => ElementPolicy::class,
        ElementAttribute::class => ElementAttributePolicy::class,
        Elementset::class       => ElementSetPolicy::class,
        Import::class           => ImportPolicy::class,
        Project::class          => ProjectPolicy::class,
        Vocabulary::class       => VocabularyPolicy::class,
        /** Module policy mapper */
        'agent'                 => ProjectPolicy::class,
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
