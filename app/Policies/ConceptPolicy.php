<?php

namespace App\Models\Policies;

use App\Models\Access\User\User;
use App\Models\Concept;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConceptPolicy
{
    use HandlesAuthorization;


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
        //project is public or user is member of project
    }


  /**
   * Determine whether the user can create concepts.
   *
   * @param  \App\Models\Access\User\User $user
   *
   * @return mixed
   */
    public function create(User $user)
    {
        //User must be one of: admin, projectadmin, vocabularyadmin
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
    }
}
