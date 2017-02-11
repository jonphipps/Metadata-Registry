<?php

namespace Tests\unit\boilerplate\Backend\Access\User;

use Tests\TestCase;
/**
 * Class UserRoleTest
 */
class UserRoleTest extends TestCase
{

    public function testAttachRoleToUserById()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole->id);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testAttachRoleToUserByObject()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testDetachRoleByIdFromUser()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole->id);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->detachRole($this->adminRole->id);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testDetachRoleByObjectFromUser()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->detachRole($this->adminRole);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testAttachRolesByIdToUser()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole->id, $this->executiveRole->id]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }

    public function testAttachRolesByObjectToUser()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole, $this->executiveRole]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }

    public function testDetachRolesByIdFromUser()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole->id, $this->executiveRole->id]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->detachRoles([$this->adminRole->id, $this->executiveRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }

    public function testDetachRolesByObjectFromUser()
    {
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole, $this->executiveRole]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseHas($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->detachRoles([$this->adminRole, $this->executiveRole]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->assertDatabaseMissing($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }
}
