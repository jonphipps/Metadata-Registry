<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->is_administrator) {
            return true;
        }
    }

  /**
   * @return bool
   */
  public function index()
  {
    return true;
  }

  /**
   * Determine whether the user can view the elementSet.
   *
   * @param  User $user
   * @param Project $project
   *
   * @return mixed
   */
  public function view(User $user, Project $project)
  {
    if ($project->is_private && $user->isMemberOfProject($project)) {
      return true;
    };
    if ( ! $project->is_private) {
      return true;
    };
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
        return \Auth::check();
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  User    $user
     * @param  Project $project
     *
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        return (bool) $user->isAdminForProjectId($project->id);
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  User    $user
     * @param  Project $project
     *
     * @return mixed
     */
    public function edit(User $user, Project $project)
    {
        return $this->update($user, $project);
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  User    $user
     * @param  Project $project
     *
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $this->update($user, $project);
    }
}
