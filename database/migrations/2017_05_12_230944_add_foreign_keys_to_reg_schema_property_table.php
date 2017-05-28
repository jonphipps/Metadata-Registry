<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToRegSchemaPropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_schema_property', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'reg_schema_property_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_schema_property_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('schema_id', 'reg_schema_property_ibfk_3')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('is_subproperty_of', 'reg_schema_property_ibfk_4')->references('id')->on('reg_schema_property')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('status_id', 'reg_schema_property_ibfk_5')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('created_by', 'reg_schema_property_ibfk_6')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_by', 'reg_schema_property_ibfk_7')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('deleted_by', 'reg_schema_property_ibfk_8')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_schema_property', function(Blueprint $table)
		{
			$table->dropForeign('reg_schema_property_ibfk_1');
			$table->dropForeign('reg_schema_property_ibfk_2');
			$table->dropForeign('reg_schema_property_ibfk_3');
			$table->dropForeign('reg_schema_property_ibfk_4');
			$table->dropForeign('reg_schema_property_ibfk_5');
			$table->dropForeign('reg_schema_property_ibfk_6');
			$table->dropForeign('reg_schema_property_ibfk_7');
			$table->dropForeign('reg_schema_property_ibfk_8');
		});
	}

}
