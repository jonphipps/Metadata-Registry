<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile_project', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('profile_id')->unsigned()->nullable()->index('profile_project_');
			$table->integer('project_id')->unsigned()->nullable()->index('profile_project_project_id');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profile_project');
	}

}
