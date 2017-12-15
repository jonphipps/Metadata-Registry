<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function before($user): ?bool
    {
        if ($user->is_administrator) {
            return true;
        }
        return null;
    }

    /** Anyone can view the list of public projects  */
    public function index(): ?bool
    {
        return true;
    }

    /** Anyone can view a non-private project
     *  Only project members can view a private project     */
    public function view(User $user, Project $project): ?bool
    {
        if ($project->is_private && $user->isMemberOfProject($project)) {
            return true;
        };
        if ( ! $project->is_private) {
            return true;
        };

        return null;
    }

    /** Any authenticated user can create a project */
    public function create(User $user): ?bool
    {
        return \Auth::check();
    }

    public function update(User $user, Project $project): ?bool
    {
        return $user->isAdminForProjectId($project->id);
    }


    public function edit(User $user, Project $project): ?bool
    {
        return $this->update($user, $project);
    }


    public function delete(User $user, Project $project): ?bool
    {
        return $this->update($user, $project);
    }

    public function import(User $user, Project $project): ?bool
    {
        return $user->isAdminForProjectId($project->id);
    }

    public function publish(User $user, Project $project = null): ?bool
    {
        return ($project && $user->isAdminForProjectId($project->id));
    }

 }
