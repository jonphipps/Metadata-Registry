<?php

/**
 * Class UserRoleTest
 */
class UserRoleTest extends TestCase
{

    public function testAttachRoleToUserById()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole->id);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testAttachRoleToUserByObject()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testDetachRoleByIdFromUser()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole->id);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->detachRole($this->adminRole->id);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testDetachRoleByObjectFromUser()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->attachRole($this->adminRole);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->user->detachRole($this->adminRole);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
    }

    public function testAttachRolesByIdToUser()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole->id, $this->executiveRole->id]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }

    public function testAttachRolesByObjectToUser()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole, $this->executiveRole]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }

    public function testDetachRolesByIdFromUser()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole->id, $this->executiveRole->id]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->detachRoles([$this->adminRole->id, $this->executiveRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }

    public function testDetachRolesByObjectFromUser()
    {
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->attachRoles([$this->adminRole, $this->executiveRole]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->seeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
        $this->user->detachRoles([$this->adminRole, $this->executiveRole]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->adminRole->id]);
        $this->notSeeInDatabase($this->roleUserTable, ['user_id' => $this->user->id, 'role_id' => $this->executiveRole->id]);
    }
}
