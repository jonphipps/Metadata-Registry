<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('project_id')->unsigned()->nullable()->index();
			$table->integer('user_id')->unsigned()->nullable()->index();
			$table->boolean('is_registrar_for')->nullable()->default(1);
			$table->boolean('is_admin_for')->nullable()->default(1);
			$table->unique(['user_id','project_id'], 'user_project_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_user');
	}

}
