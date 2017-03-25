<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Concept;
use App\Models\Vocabulary;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConceptPolicy
{
  use HandlesAuthorization;

  public function before(User $user)
  {
    if ($user->is_administrator) {
      return true;
    }
  }

  /**
   * Determine whether the user can view the concept.
   *
   * @param  \App\Models\Access\User\User $user
   * @param  \App\Models\Concept $concept
   *
   * @return mixed
   */
  public function view(User $user, Concept $concept)
  {
    $project = $concept->vocabulary->project;
    if ($project->is_private && $user->isMemberOfProject($project)) {
      return true;
    };
    if ( ! $project->is_private) {
      return true;
    };

  }

  /**
   * Determine whether the user can create concepts.
   *
   * @param  \App\Models\Access\User\User $user
   * @param Vocabulary $vocabulary
   *
   * @return mixed
   */
  public function create(User $user, Vocabulary $vocabulary)
  {
    //User must be one of: admin, projectadmin, vocabularyadmin
    if ($user->ismaintainerForVocabulary($vocabulary)) {
      return true;
    }
  }

  /**
   * Determine whether the user can update the concept.
   *
   * @param  \App\Models\Access\User\User $user
   * @param  \App\Models\Concept $concept
   *
   * @return mixed
   */
  public function update(User $user, Concept $concept)
  {
    //User must be one of: admin, projectadmin, vocabularyadmin
    if ($user->ismaintainerForVocabulary($concept->vocabulary)) {
      return true;
    }
  }

  /**
   * Determine whether the user can delete the concept.
   *
   * @param  \App\Models\Access\User\User $user
   * @param  \App\Models\Concept $concept
   *
   * @return mixed
   */
  public function delete(User $user, Concept $concept)
  {
    //User must be one of: admin, projectadmin, vocabularyadmin
    if ($user->ismaintainerForVocabulary($concept->vocabulary)) {
      return true;
    }
  }
}
