<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call( AdminSeeder::class );

        $this->call( SkosPropertySeeder::class );
        $this->call( StatusSeeder::class );
        $this->call( ProfileSeeder::class );
        $this->call( ProfilePropertySeeder::class );
        if ( in_array( app()->environment(), [ 'local', 'testing' ], true ) ) {
            //$this->call(PrefixSeeder::class);
            $this->call( ProjectSeeder::class );
            $this->call( RDAClassesSeeder::class );
            $this->call( RDAMediaTypeSeeder::class );
            $this->call( RDAImportExportSeeder::class );
        }
    }
}
