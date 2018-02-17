<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\Project;
use App\Models\Vocabulary;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Schema;

class VocabularyPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->is_administrator) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the vocabulary.
     *
     * @param  User $user
     * @param  Vocabulary $vocabulary
     *
     * @return mixed
     */
    public function view(User $user, Vocabulary $vocabulary)
    {
        {
        $project = $vocabulary->project;
        if ($project->is_private && $user->isMemberOfProject($project)) {
            return true;
        }
        if (! $project->is_private) {
            return true;
        }
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
        return $project && $user->isAdminForProjectId($project->id);
    }

    public function listTableForeignKeys($table)
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        return array_map(

            function ($key) {
                /* @var \Doctrine\DBAL\Schema\ForeignKeyConstraint $key */
                return $key->getName();
            },
            $conn->listTableForeignKeys($table)
        );
    }

    /** update the vocabulary.
     *
     * @param  User $user
     * @param  Vocabulary $vocabulary
     *
     * @return mixed
     */
    public function update(User $user, Vocabulary $vocabulary)
    {
        if ($user->isAdminForVocabulary($vocabulary)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the vocabulary.
     *
     * @param  User $user
     * @param  Vocabulary $vocabulary
     *
     * @return mixed
     */
    public function delete(User $user, Vocabulary $vocabulary)
    {
        if ($user->isAdminForVocabulary($vocabulary)) {
            return true;
        }
    }
}
