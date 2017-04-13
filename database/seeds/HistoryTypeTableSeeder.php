<?php

use database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use database\DisablesForeignKeys;
use Illuminate\Support\Facades\DB;

/**
 * Class HistoryTypeTableSeeder
 */
class HistoryTypeTableSeeder extends Seeder
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
        $this->truncate('history_types');

    $types = [
        [
            'id'         => 1,
            'name'       => 'User',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'id'         => 2,
            'name'       => 'Role',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
    ];

    DB::table('history_types')->insert($types);

    $this->enableForeignKeys();
  }
}
