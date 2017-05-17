<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProjectUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_user', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_p_31413_31422_project__5904d51356ff3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('project_id', 'fk_p_31422_31413_user_pro_5904d51356f0e')->references('id')->on('projects')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project_user', function(Blueprint $table)
		{
			$table->dropForeign('fk_p_31413_31422_project__5904d51356ff3');
			$table->dropForeign('fk_p_31422_31413_user_pro_5904d51356f0e');
		});
	}

}
