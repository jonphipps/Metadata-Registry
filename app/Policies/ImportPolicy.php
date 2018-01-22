<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Import;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImportPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->is_administrator) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the import.
     *
     * @param  User  $user
     * @param  \App\Models\Import  $import
     * @return mixed
     */
    public function view(User $user, Import $import)
    {
        return true;
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  User    $user
     * @param  Project $project
     *
     * @return mixed
     */
    public function importProject(User $user, Project $project)
    {
        return (bool) $user->isAdminForProjectId($project->id);
    }

    /**
     * Determine whether the user can create imports.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user, Project $project)
    {
        return (bool) $user->isAdminForProjectId($project->id);
    }

    /**
     * Determine whether the user can update the import.
     *
     * @param  User  $user
     * @param  \App\Models\Import  $import
     * @return mixed
     */
    public function update(User $user, Import $import)
    {
        //
    }

    /**
     * Determine whether the user can delete the import.
     *
     * @param  User  $user
     * @param  \App\Models\Import  $import
     * @return mixed
     */
    public function delete(User $user, Import $import)
    {
        //
    }
}
