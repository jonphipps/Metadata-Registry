<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->default(0)->index();
			$table->integer('role_id')->unsigned()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_user');
	}

}
