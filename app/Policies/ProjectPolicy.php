<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
  use HandlesAuthorization;


  /**
   * Determine whether the user can view the project.
   *
   * @param  User $user
   * @param  Project $project
   *
   * @return mixed
   */
  public function view(User $user, Project $project)
  {
    //
  }


  /**
   * Determine whether the user can create projects.
   *
   * @param  User $user
   *
   * @return mixed
   */
  public function create(User $user)
  {
    $user->hasRole('user');
  }


  /**
   * Determine whether the user can update the project.
   *
   * @param  User $user
   * @param  Project $project
   *
   * @return mixed
   */
  public function update(User $user, Project $project)
  {
    //
  }


  /**
   * Determine whether the user can delete the project.
   *
   * @param  User $user
   * @param  Project $project
   *
   * @return mixed
   */
  public function delete(User $user, Project $project)
  {
    //
  }
}
