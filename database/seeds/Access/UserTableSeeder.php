<?php

use Carbon\Carbon as Carbon;
use Database\DisablesForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisablesForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncateMultiple([config('access.users_table'), 'social_logins']);

        //Add the master administrator, user id of 1
        $users = [
            [
                'id'                => '1',
                'name'              => 'adminuser',
                'first_name'        => 'Admin',
                'last_name'         => 'User',
                'nickname'          => 'adminuser',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt( '1234' ),
                'confirmation_code' => md5( uniqid( mt_rand(), true ) ),
                'confirmed'         => true,
                'culture'           => 'en_US',
                'is_administrator'  => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '2',
                'name'              => 'backenduser',
                'first_name'        => 'Backend',
                'last_name'         => 'User',
                'nickname'          => 'backenduser',
                'email'             => 'executive@executive.com',
                'password'          => bcrypt( '1234' ),
                'confirmation_code' => md5( uniqid( mt_rand(), true ) ),
                'confirmed'         => true,
                'culture'           => 'en_US',
                'is_administrator'  => false,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '3',
                'name'              => 'defaultuser',
                'first_name'        => 'Default',
                'last_name'         => 'User',
                'nickname'          => 'defaultuser',
                'email'             => 'user@user.com',
                'password'          => bcrypt( '1234' ),
                'confirmation_code' => md5( uniqid( mt_rand(), true ) ),
                'confirmed'         => true,
                'culture'           => 'en_US',
                'is_administrator'  => false,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '36',
                'name'              => 'jonphipps',
                'first_name'        => 'Jon',
                'last_name'         => 'Phipps',
                'nickname'          => 'jonphipps',
                'email'             => 'jphipps@madcreek.com',
                'password'          => bcrypt( '1234' ),
                'confirmation_code' => md5( uniqid( mt_rand(), true ) ),
                'confirmed'         => true,
                'culture'           => 'en_US',
                'is_administrator'  => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '39',
                'name'              => 'Diane',
                'first_name'        => 'Diane',
                'last_name'         => 'Hillmann',
                'nickname'          => 'Diane',
                'email'             => 'diane.hillmann@cornell.edu',
                'password'          => bcrypt( '1234' ),
                'confirmation_code' => md5( uniqid( mt_rand(), true ) ),
                'confirmed'         => true,
                'culture'           => 'en_US',
                'is_administrator'  => true,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id'                => '177',
                'name'              => 'JSCChair',
                'first_name'        => 'RSC',
                'last_name'         => 'Chair',
                'nickname'          => 'JSCChair',
                'email'             => 'big.cheese@rdatoolkit.org',
                'password'          => bcrypt( '1234' ),
                'confirmation_code' => md5( uniqid( mt_rand(), true ) ),
                'confirmed'         => true,
                'culture'           => 'en_US',
                'is_administrator'  => false,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ];

        DB::table( config( 'access.users_table' ) )->insert( $users );

        $this->enableForeignKeys();
    }
}
