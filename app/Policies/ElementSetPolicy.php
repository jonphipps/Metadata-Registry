<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Elementset;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ElementSetPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->is_administrator) {
            return true;
        }
    }

  /**
   * Determine whether the user can view the elementSet.
   *
   * @param  User $user
   * @param  Elementset $elementset
   *
   * @return mixed
   */
    public function view(User $user, Elementset $elementset)
    {
        $project = $elementset->project;
        if ($project->is_private && $user->isMemberOfProject($project)) {
            return true;
        };
      if (!$project->is_private) {
        return true;
      };
    }


  /**
   * Determine whether the user can create Elementsets.
   * @param  User   $user
   * @param Project $project
   *
   * @return mixed
   */
    public function create(User $user, Project $project = null)
    {
        return ($project && $user->isAdminForProjectId($project->id));
    }

    /**
   * Determine whether the user can update the elementSet.
   *
   * @param  User $user
   * @param  Elementset $elementset
   *
   * @return mixed
   */
    public function update(User $user, Elementset $elementset)
    {
        if ($user->isAdminForElementSet($elementset)) {
            return true;
        }
    }


  /**
   * Determine whether the user can delete the elementSet.
   *
   * @param  User $user
   * @param  Elementset $elementset
   *
   * @return mixed
   */
    public function delete(User $user, Elementset $elementset)
    {
      if ($user->isAdminForElementSet($elementset)) {
        return true;
      }
    }
}
