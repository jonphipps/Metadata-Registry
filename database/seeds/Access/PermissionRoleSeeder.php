<?php

use Database\TruncateTable;
use Illuminate\Database\Seeder;
use App\Models\Access\Role\Role;
use Database\DisableForeignKeys;

/**
 * Class PermissionRoleSeeder.
 */
class PermissionRoleSeeder extends Seeder
{

    use DisableForeignKeys, TruncateTable;


  /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.permission_role_table'));

        /*
         * Assign view backend to executive role as example
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
