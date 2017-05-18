<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProfileProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profile_project', function(Blueprint $table)
		{
			$table->foreign('profile_id', 'profile_project_ibfk_1')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('RESTRICT');
			$table->foreign('project_id', 'profile_project_ibfk_2')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profile_project', function(Blueprint $table)
		{
			$table->dropForeign('profile_project_ibfk_1');
			$table->dropForeign('profile_project_ibfk_2');
		});
	}

}
