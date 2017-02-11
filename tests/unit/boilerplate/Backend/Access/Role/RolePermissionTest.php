<?php

namespace Tests\unit\boilerplate\Backend\Access\Role;

use App\Models\Access\Permission\Permission;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{

    public function testSavePermissionsToRole()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 3, 'role_id' => $this->userRole->id]);
        $this->userRole->permissions()->sync([1, 2]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 3, 'role_id' => $this->userRole->id]);
    }

    public function testEmptyPermissionsFromRole()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->permissions()->sync([1, 2]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->permissions()->sync([]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
    }

    public function testAttachPermissionToRoleById()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermission(1);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
    }

    public function testAttachPermissionToRoleByObject()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermission(Permission::findOrFail(1));
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
    }

    public function testDetachPermissionFromRoleById()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermission(1);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->userRole->detachPermission(1);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
    }

    public function testDetachPermissionFromRoleByObject()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermission(Permission::findOrFail(1));
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->userRole->detachPermission(Permission::findOrFail(1));
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
    }

    public function testAttachPermissionsToRoleById()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermissions([1, 2]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
    }

    public function testAttachPermissionsToRoleByObject()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermissions([Permission::findOrFail(1), Permission::findOrFail(2)]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
    }

    public function testDetachPermissionsFromRoleById()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermissions([1, 2]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->detachPermissions([1, 2]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
    }

    public function testDetachPermissionsFromRoleByObject()
    {
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->attachPermissions([Permission::findOrFail(1), Permission::findOrFail(2)]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseHas($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
        $this->userRole->detachPermissions([Permission::findOrFail(1), Permission::findOrFail(2)]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 1, 'role_id' => $this->userRole->id]);
        $this->assertDatabaseMissing($this->permissionRoleTable, ['permission_id' => 2, 'role_id' => $this->userRole->id]);
    }
}
