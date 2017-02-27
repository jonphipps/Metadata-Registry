<?php

namespace App\Providers;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\ElementSet;
use App\Policies\ConceptAttributePolicy;
use App\Policies\ConceptPolicy;
use App\Models\Project;
use App\Models\Vocabulary;
use App\Policies\ElementSetPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\VocabularyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
      Project::class          => ProjectPolicy::class,
      Vocabulary::class       => VocabularyPolicy::class,
      Concept::class          => ConceptPolicy::class,
      ConceptAttribute::class => ConceptAttributePolicy::class,
      ElementSet::class       => ElementSetPolicy::class,
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
