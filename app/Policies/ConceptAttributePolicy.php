<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\ConceptAttribute;
use App\Models\Vocabulary;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConceptAttributePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->is_administrator) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the conceptAttribute.
     *
     * @param User $user
     * @param ConceptAttribute $conceptAttribute
     *
     * @return mixed
     */
    public function view(User $user, ConceptAttribute $conceptAttribute)
    {
        $project = $conceptAttribute->concept->vocabulary->project;
        if ($project->is_private && $user->isMemberOfProject($project)) {
            return true;
        }
        if (! $project->is_private) {
            return true;
        }
    }

    /**
     * Determine whether the user can create conceptAttributes.
     *
     * @param User $user
     * @param Vocabulary $vocabulary
     *
     * @return mixed
     */
    public function create(User $user, Vocabulary $vocabulary)
    {
        //User must be one of: admin, projectadmin, vocabularyadmin
        if ($user->isMaintainerForVocabulary($vocabulary)) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the conceptAttribute.
     *
     * @param User $user
     * @param ConceptAttribute $conceptAttribute
     *
     * @return mixed
     */
    public function update(User $user, ConceptAttribute $conceptAttribute)
    {
        //User must be one of: admin, projectadmin, vocabularyadmin
        if ($user->isMaintainerForVocabulary($conceptAttribute->concept->vocabulary)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the conceptAttribute.
     *
     * @param User $user
     * @param ConceptAttribute $conceptAttribute
     *
     * @return mixed
     */
    public function delete(User $user, ConceptAttribute $conceptAttribute)
    {
        //User must be one of: admin, projectadmin, vocabularyadmin
        if ($user->isMaintainerForVocabulary($conceptAttribute->concept->vocabulary)) {
            return true;
        }
    }
}
