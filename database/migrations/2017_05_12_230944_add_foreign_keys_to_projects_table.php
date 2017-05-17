<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('created_by', 'projects_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_by', 'projects_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('deleted_by', 'projects_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropForeign('projects_ibfk_1');
			$table->dropForeign('projects_ibfk_2');
			$table->dropForeign('projects_ibfk_3');
		});
	}

}
