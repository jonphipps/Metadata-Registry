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
        if ( 'testing' === app()->environment() ) {
            $this->call( DatabaseTestSeeder::class );
        }
    }
}
