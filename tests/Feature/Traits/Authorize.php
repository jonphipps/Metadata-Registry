<?php

namespace Tests\Feature\Traits;

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-06-10,  Time: 10:21 AM */

use App\Models\Access\User\User;
use Illuminate\Support\Facades\Auth;
use Tests\Traits\TestData;

trait Authorize
{
    protected function IAmLoggedIn($user = null)
    {
        if ($user) {
            $this->actingAs($user);
        } else {
            $this->actingAs($this->user);
        }
    }

    protected function IAmNotLoggedIn()
    {
        Auth::logout();
    }

    protected function IAmTheProjectAdministrator()
    {
        $user = User::find(self::getTestData()['project']['adminId']);
        $this->actingAs($user);
    }

    protected function andIAmLoggedIn()
    {
        $this->IAmLoggedIn();
    }

    protected function andIAmTheProjectAdministrator()
    {
        $this->IAmTheProjectAdministrator();
    }

    protected function givenIAmLoggedIn()
    {
        $this->IAmLoggedIn();
    }

    protected function givenIAmTheProjectAdministrator()
    {
        $this->IAmTheProjectAdministrator();
    }

    protected function whenIAmLoggedIn()
    {
        $this->IAmLoggedIn();
    }

    protected function whenIAmTheProjectAdministrator()
    {
        $this->IAmTheProjectAdministrator();
    }
}
