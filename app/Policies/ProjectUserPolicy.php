<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use App\Models\ProjectUser;
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

    /** Anyone can view a non-private project
     *  Only project members can view a private project
     *
     * @param User        $user
     * @param ProjectUser $projectUser
     *
     * @return bool|null
     */
    public function view(User $user, ProjectUser $projectUser): ?bool
    {
        $project = $this->getProject($projectUser);
        if ($project) {
            if ($project->is_private && $user->isMemberOfProject($project)) {
                return true;
            };
            if ( ! $project->is_private) {
                return true;
            };
        }

        return null;
    }

    /**
     * @param User $user
     *
     * @return bool|null
     */
    public function create(User $user): ?bool
    {
        $project = Project::find(request()->project);

        return $user->isAdminForProjectId($project->id);
    }

    public function update(User $user, ProjectUser $projectUser): ?bool
    {
        $project = $this->getProject($projectUser);

        return $user->isAdminForProjectId($project->id);
    }

    public function delete(User $user, ProjectUser $projectUser): ?bool
    {
        return $this->update($user, $projectUser);
    }

    /**
     * @param ProjectUser $projectUser
     *
     * @return Project|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    private function getProject(ProjectUser $projectUser)
    {
        if ($projectUser->exists) {
            $project = $projectUser->project;
        } else {
            $project = Project::find(request()->project);
        }

        return $project;
    }
}
