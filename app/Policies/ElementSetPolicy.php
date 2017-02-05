<?php

namespace App\Policies;

use App\Models\Access\User\User;
use App\Models\ElementSet;
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
        //
    }


  /**
   * Determine whether the user can create elementSets.
   *
   * @param  User $user
   *
   * @return mixed
   */
    public function create(User $user)
    {
        //
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
