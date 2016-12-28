<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{

  /**
   * Auto generated seed file
   *
   * @return void
   */
  public function run()
  {
    DB::table('employees')->delete();
    factory(\App\Models\Employees::class, 10)->create();

  }

}
