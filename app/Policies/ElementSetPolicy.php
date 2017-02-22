<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\ElementSet;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ElementSetPolicy
{
    use HandlesAuthorization;


  /**
   * Determine whether the user can view the elementSet.
   *
   * @param  User $user
   * @param  ElementSet $elementSet
   *
   * @return mixed
   */
    public function view(User $user, ElementSet $elementSet)
    {
        $project = $elementSet->project();
        if ($project->is_private && $user->isMemberOfProjectId($project->id)) {
            return true;
        };
    }


  /**
   * Determine whether the user can create elementSets.
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
   * @param  ElementSet $elementSet
   *
   * @return mixed
   */
    public function update(User $user, ElementSet $elementSet)
    {
        //
    }


  /**
   * Determine whether the user can delete the elementSet.
   *
   * @param  User $user
   * @param  ElementSet $elementSet
   *
   * @return mixed
   */
    public function delete(User $user, ElementSet $elementSet)
    {
        //
    }
}
