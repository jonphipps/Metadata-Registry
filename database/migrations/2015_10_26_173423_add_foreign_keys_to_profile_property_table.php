<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProfilePropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profile_property', function(Blueprint $table)
		{
			$table->foreign('profile_id', 'profile_property_ibfk_1')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('RESTRICT');
			$table->foreign('inverse_profile_property_id', 'profile_property_ibfk_2')->references('id')->on('profile_property')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status_id', 'profile_property_ibfk_3')->references('id')->on('reg_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('updated_by', 'profile_property_ibfk_4')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('created_by', 'profile_property_ibfk_5')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('deleted_by', 'profile_property_ibfk_6')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profile_property', function(Blueprint $table)
		{
			$table->dropForeign('profile_property_ibfk_1');
			$table->dropForeign('profile_property_ibfk_2');
			$table->dropForeign('profile_property_ibfk_3');
			$table->dropForeign('profile_property_ibfk_4');
			$table->dropForeign('profile_property_ibfk_5');
			$table->dropForeign('profile_property_ibfk_6');
		});
	}

}
