<?php

use Illuminate\Database\Seeder;
use App\Models\Access\Role\Role;

/**
 * Class PermissionRoleSeeder
 */
class PermissionRoleSeeder extends Seeder
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
      DB::table(config('access.permission_role_table'))->truncate();
    } elseif (DB::connection()->getDriverName() == 'sqlite') {
      DB::statement('DELETE FROM ' . config('access.permission_role_table'));
    } else {
      //For PostgreSQL or anything else
      DB::statement('TRUNCATE TABLE ' . config('access.permission_role_table') . ' CASCADE');
    }

    /**
     * Assign view backend and manage user permissions to executive role as example
     */

    Role::find(2)->permissions()->sync([ 1, 2 ]); // Executive
    Role::find(3)->permissions()->sync([ 4 ]); //Subscriber
    Role::find(4)->permissions()->sync([ 5, 6, 7, 9,12,13,14 ]); //agentadmin
    Role::find(5)->permissions()->sync([ 9 ]); //agentmember
    Role::find(6)->permissions()->sync([ 6, 7, 9,10,11,12,13,14 ]); //agentmaintainer
    Role::find(7)->permissions()->sync([ 6, 9, 10, 13 ]); //schemaadmin
    Role::find(8)->permissions()->sync([ 6, 9 ]); //schemamaintainer
    Role::find(9)->permissions()->sync([ 7, 9 ]); //vocabularymaintainer
    Role::find(10)->permissions()->sync([ 7, 9, 11, 14 ]); //vocabularyadmin

    $this->enableForeignKeys();
  }
}
