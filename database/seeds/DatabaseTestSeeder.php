<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //$this->call(PrefixSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(RDAClassesSeeder::class);
        $this->call(RDAMediaTypeSeeder::class);
        $this->call(RDAImportExportSeeder::class);
    }
}
