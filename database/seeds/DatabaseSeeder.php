<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//		Model::unguard();
        // $this->call(UserTableSeeder::class);
//    	$this->call(EmployeesTableSeeder::class);
//		$this->call(OrdersTableSeeder::class);

        $this->call(SkosPropertySeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(ProfilePropertySeeder::class);
        $this->call(PrefixSeeder::class);

//		Model::reguard();
    }
}
