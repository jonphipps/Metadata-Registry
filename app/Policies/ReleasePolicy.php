<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReleasePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->is_administrator) {
            return true;
        }
    }


    /** Anyone can view a non-private project
     *  Only project members can view a private project     */
    public function index(User $user, Project $project): ?bool
    {
        if ($project->is_private && $user->isMemberOfProject($project)) {
            return true;
        };
        if ( ! $project->is_private) {
            return true;
        };
    }
        /**
     * Determine whether the user can view the vocabulary.
     *
     * @param  User   $user
     * @param Project $project
     *
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
      {
        if ($project->is_private && $user->isMemberOfProject($project)) {
          return true;
        };
        if ( ! $project->is_private) {
          return true;
        };
      }

    }

    /** * Determine whether the user can create vocabularies.
     *
     * @param  User   $user
     * @param Project $project
     *
     * @return mixed
     */
    public function create(User $user, Project $project = null)
    {
        return ($project && $user->isAdminForProjectId($project->id));
    }


    /** update the vocabulary.
     *
     * @param  User        $user
     * @param Project|null $project
     *
     * @return mixed
     */
    public function update(User $user, Project $project = null)
    {
        return ($project && $user->isAdminForProjectId($project->id));
    }

    /**
     * Determine whether the user can delete the release.
     *
     * @param  User        $user
     * @param Project|null $project
     *
     * @return mixed
     */
    public function delete(User $user, Project $project = null)
    {
        return ($project && $user->isAdminForProjectId($project->id));
    }

}
