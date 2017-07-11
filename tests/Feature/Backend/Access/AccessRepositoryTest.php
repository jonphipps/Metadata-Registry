<?php

namespace Tests\Feature\Backend\Access;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class AccessRepositoryTest.
 */
class AccessRepositoryTest extends BrowserKitTestCase
{
  use DatabaseTransactions;

    public function testGetUsersByPermissionUsingName()
    {
        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByPermission('view-backend')
            ->toArray();

        $this->assertCount(1, $results);
        $this->assertArraySubset(['nickname' => $this->executive->nickname], $results[0]);
    }

    public function testGetUsersByPermissionsUsingNames()
    {
        $this->userRole->permissions()->sync([1]);

        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByPermission(['view-backend'])
            ->toArray();

        $this->assertCount(2, $results);
        $this->assertArraySubset(['nickname' => $this->executive->nickname], $results[0]);
        $this->assertArraySubset(['nickname' => $this->user->nickname], $results[1]);
    }

    public function testGetUsersByPermissionUsingId()
    {
        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByPermission(1, 'id')
            ->toArray();

        $this->assertCount(1, $results);
        $this->assertArraySubset(['nickname' => $this->executive->nickname], $results[0]);
    }

    public function testGetUsersByPermissionsUsingIds()
    {
        $this->userRole->permissions()->sync([1]);

        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByPermission([1], 'id')
            ->toArray();

        $this->assertCount(2, $results);
        $this->assertArraySubset(['nickname' => $this->executive->nickname], $results[0]);
        $this->assertArraySubset(['nickname' => $this->user->nickname], $results[1]);
    }

    public function testGetUsersByRoleUsingName()
    {
        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByRole('User')
            ->toArray();

        $this->assertCount(1, $results);
        $this->assertArraySubset(['nickname' => $this->user->nickname], $results[0]);
    }

    public function testGetUsersByRolesUsingNames()
    {
        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByRole(['User', 'Executive'])
            ->toArray();

        $this->assertCount(2, $results);
        $this->assertArraySubset(['nickname' => $this->executive->nickname], $results[0]);
        $this->assertArraySubset(['nickname' => $this->user->nickname], $results[1]);
    }

    public function testGetUsersByRoleUsingId()
    {
        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByRole(1, 'id')
            ->toArray();

        $this->assertCount(3, $results);
        $this->assertArraySubset(['nickname' => $this->admin->nickname], $results[0]);
    }

    public function testGetUsersByRolesUsingIds()
    {
        $results = app()->make(\App\Repositories\Backend\Access\User\UserRepository::class)
            ->getByRole([1, 3], 'id')
            ->toArray();

        $this->assertCount(4, $results);
        $this->assertArraySubset(['nickname' => $this->admin->nickname], $results[0]);
        $this->assertArraySubset(['nickname' => $this->user->nickname], $results[1]);
    }
}
