<?php

use Illuminate\Database\Seeder;

class ProfilePropertySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $updateStatement = file_get_contents(__DIR__ .'/ProfilePropertySeeder.sql');
        DB::statement($updateStatement);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
