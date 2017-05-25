<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\ElementAttribute;
use App\Models\Elementset;
use Illuminate\Auth\Access\HandlesAuthorization;

class ElementAttributePolicy
{
    use HandlesAuthorization;

  public function before(User $user)
  {
    if ($user->is_administrator) {
      return true;
    }
  }

  /**
     * Determine whether the user can view the elementAttribute.
     *
     * @param  \App\Models\Access\User\User  $user
     * @param  \App\Models\ElementAttribute  $elementAttribute
     * @return mixed
     */
  public function view(User $user, ElementAttribute $elementAttribute)
  {
    $project = $elementAttribute->element->elementSet->project;
    if ($project->is_private && $user->isMemberOfProject($project)) {
      return true;
    };
    if ( ! $project->is_private) {
      return true;
    };
  }

  /**
     * Determine whether the user can create elementAttributes.
     *
     * @param  \App\Models\Access\User\User  $user
     * @return mixed
     */
  public function create(User $user, Elementset $elementSet)
    {
    //User must be one of: admin, projectadmin, vocabularyadmin
    if ($user->isMaintainerForElementSet($elementSet)) {
      return true;
    }
    }

    /**
     * Determine whether the user can update the elementAttribute.
     *
     * @param  \App\Models\Access\User\User  $user
     * @param  \App\Models\ElementAttribute  $elementAttribute
     * @return mixed
     */
    public function update(User $user, ElementAttribute $elementAttribute)
    {
      //User must be one of: admin, projectadmin, vocabularyadmin
      if ($user->isMaintainerForElementSet($elementAttribute->element->elementSet)) {
        return true;
      }
    }

    /**
     * Determine whether the user can delete the elementAttribute.
     *
     * @param  \App\Models\Access\User\User  $user
     * @param  \App\Models\ElementAttribute  $elementAttribute
     * @return mixed
     */
    public function delete(User $user, ElementAttribute $elementAttribute)
    {
      //User must be one of: admin, projectadmin, vocabularyadmin
      if ($user->isMaintainerForElementSet($elementAttribute->element->elementSet)) {
        return true;
      }
    }
}
