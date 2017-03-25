<?php

namespace App\Providers;

use App\Models\Concept;
use App\Models\ConceptAttribute;
use App\Models\Element;
use App\Models\ElementAttribute;
use App\Models\ElementSet;
use App\Policies\ConceptAttributePolicy;
use App\Policies\ConceptPolicy;
use App\Models\Project;
use App\Models\Vocabulary;
use App\Policies\ElementAttributePolicy;
use App\Policies\ElementPolicy;
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
      'App\Model'       => 'App\Policies\ModelPolicy',
      Project::class    => ProjectPolicy::class,
      Vocabulary::class => VocabularyPolicy::class,
      Concept::class          => ConceptPolicy::class,
      ConceptAttribute::class => ConceptAttributePolicy::class,
      ElementSet::class => ElementSetPolicy::class,
      Element::class          => ElementPolicy::class,
      ElementAttribute::class => ElementAttributePolicy::class,
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
