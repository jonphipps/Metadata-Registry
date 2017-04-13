<?php

use Illuminate\Database\Seeder;

class ProfilePropertySeeder extends Seeder
{

    use \Database\DisablesForeignKeys;


  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        $this->disableForeignKeys();

        $updateStatement = file_get_contents(__DIR__ . '/ProfilePropertySeeder.sql');
        DB::statement($updateStatement);

        $this->enableForeignKeys();
    }
}
