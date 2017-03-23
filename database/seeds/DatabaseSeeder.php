<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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

        $this->call(AdminSeeder::class);

        $this->call(SkosPropertySeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ProfilePropertySeeder::class);
        $this->call(PrefixSeeder::class);

        Model::reguard();
    }
}
