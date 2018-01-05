<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectUserPolicy
{
    use HandlesAuthorization;

    public function before($user): ?bool
    {
        if ($user->is_administrator) {
            return true;
        }
        return null;
    }

    /**
     * @param User    $user
     * @param Project $project
     *
     * @return bool|null
     */
    public function index(User $user, Project $project): ?bool
    {
        return $this->view($user, $project);
    }
    public function list(User $user, Project $project)
    {
        $this->index($user, $project);
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

    /**
     * @param User    $user
     * @param Project $project
     *
     * @return bool|null
     */
    public function create(User $user, Project $project): ?bool
    {
        return $user->isAdminForProjectId($project->id);
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

 }
