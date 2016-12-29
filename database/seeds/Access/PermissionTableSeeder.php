<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class PermissionTableSeeder
 */
class PermissionTableSeeder extends Seeder
{

  use \database\DisablesForeignKeys;


  /**
   * Run the database seed.
   *
   * @return void
   */
  public function run()
  {
    $this->disableForeignKeys();

    if (DB::connection()->getDriverName() == 'mysql') {
      DB::table(config('access.permissions_table'))->truncate();
      DB::table(config('access.permission_role_table'))->truncate();
    } elseif (DB::connection()->getDriverName() == 'sqlite') {
      DB::statement('DELETE FROM ' . config('access.permissions_table'));
      DB::statement('DELETE FROM ' . config('access.permission_role_table'));
    } else {
      //For PostgreSQL or anything else
      DB::statement('TRUNCATE TABLE ' . config('access.permissions_table') . ' CASCADE');
      DB::statement('TRUNCATE TABLE ' . config('access.permission_role_table') . ' CASCADE');
    }

    /**
     * Don't need to assign any permissions to administrator because the all flag is set to true
     * in RoleTableSeeder.php
     */

    /**
     * Misc Access Permissions
     */
    $permission_model          = config('access.permission');
    $viewBackend               = new $permission_model;
    $viewBackend->name         = 'view-backend';
    $viewBackend->display_name = 'View Backend';
    $viewBackend->sort         = 2;
    $viewBackend->created_at   = Carbon::now();
    $viewBackend->updated_at   = Carbon::now();
    $viewBackend->save();

    /**
     * Access Permissions
     */
    $permission_model          = config('access.permission');
    $manageUsers               = new $permission_model;
    $manageUsers->name         = 'manage-users';
    $manageUsers->display_name = 'Manage Users';
    $manageUsers->sort         = 3;
    $manageUsers->created_at   = Carbon::now();
    $manageUsers->updated_at   = Carbon::now();
    $manageUsers->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'manage-roles';
    $manageRoles->display_name = 'Manage Roles';
    $manageRoles->sort         = 4;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'create-project';
    $manageRoles->display_name = 'Create a Project';
    $manageRoles->sort         = 5;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'edit-project';
    $manageRoles->display_name = 'Edit a Project';
    $manageRoles->sort         = 6;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'edit-schema';
    $manageRoles->display_name = 'Edit an Element Set';
    $manageRoles->sort         = 10;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'edit-vocab';
    $manageRoles->display_name = 'Edit a Vocabulary';
    $manageRoles->sort         = 13;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'view-project';
    $manageRoles->display_name = 'View a Private Project';
    $manageRoles->sort         = 8;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'create-schema';
    $manageRoles->display_name = 'Create an Element Set';
    $manageRoles->sort         = 9;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'create-vocab';
    $manageRoles->display_name = 'Create a Vocabulary';
    $manageRoles->sort         = 12;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'delete-project';
    $manageRoles->display_name = 'Delete a Project';
    $manageRoles->sort         = 7;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'delete-schema';
    $manageRoles->display_name = 'Delete an Element Set';
    $manageRoles->sort         = 11;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'delete-vocab';
    $manageRoles->display_name = 'Delete a Vocabulary';
    $manageRoles->sort         = 14;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $permission_model          = config('access.permission');
    $manageRoles               = new $permission_model;
    $manageRoles->name         = 'edit-self';
    $manageRoles->display_name = 'Edit Self';
    $manageRoles->sort         = 1;
    $manageRoles->created_at   = Carbon::now();
    $manageRoles->updated_at   = Carbon::now();
    $manageRoles->save();

    $this->enableForeignKeys();
  }
}
