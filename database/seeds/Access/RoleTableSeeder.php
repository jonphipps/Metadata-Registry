<?php

use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;

/**
 * Class RoleTableSeeder
 */
class RoleTableSeeder extends Seeder
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
      DB::table(config('access.roles_table'))->truncate();
    } elseif (DB::connection()->getDriverName() == 'sqlite') {
      DB::statement('DELETE FROM ' . config('access.roles_table'));
      DB::statement('UPDATE sqlite_sequence SET seq = 0 where name = ' . "'" . config('access.roles_table') . "'");

    } else {
      //For PostgreSQL or anything else
      DB::statement('TRUNCATE TABLE ' . config('access.roles_table') . ' CASCADE');
    }

    $roles = [
        [
            'name'         => 'administrator',
            'display_name' => 'Administrator',
            'all'          => true,
            'sort'         => 1,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'executive',
            'display_name' => 'Executive',
            'all'          => false,
            'sort'         => 2,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'subscriber',
            'display_name' => 'Subscriber',
            'all'          => false,
            'sort'         => 3,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'agentadmin',
            'display_name' => 'Project Administrator',
            'all'          => false,
            'sort'         => 4,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'agentmember',
            'display_name' => 'Project Member',
            'all'          => false,
            'sort'         => 5,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'agentmaintainer',
            'display_name' => 'Project Maintainer',
            'all'          => false,
            'sort'         => 6,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'schemaadmin',
            'display_name' => 'Element Set Administrator',
            'all'          => false,
            'sort'         => 7,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),   ],
        [
            'name'         => 'schemamaintainer',
            'display_name' => 'Element Set Maintainer',
            'all'          => false,
            'sort'         => 8,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'vocabularyadmin',
            'display_name' => 'Vocabulary Administrator',
            'all'          => false,
            'sort'         => 9,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],
        [
            'name'         => 'vocabularymaintainer',
            'display_name' => 'Vocabulary Maintainer',
            'all'          => false,
            'sort'         => 10,
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ],

    ];

    DB::table(config('access.roles_table'))->insert($roles);

    $this->enableForeignKeys();
  }
}
