<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegSchemaPropertyElementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_schema_property_element', function(Blueprint $table)
		{
			$table->foreign('profile_property_id', 'reg_schema_property_element_ibfk_1')->references('id')->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('created_user_id', 'reg_schema_property_element_ibfk_2')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('updated_user_id', 'reg_schema_property_element_ibfk_3')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('schema_property_id', 'reg_schema_property_element_ibfk_4')->references('id')->on('reg_schema_property')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('related_schema_property_id', 'reg_schema_property_element_ibfk_5')->references('id')->on('reg_schema_property')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('status_id', 'reg_schema_property_element_ibfk_6')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_schema_property_element', function(Blueprint $table)
		{
			$table->dropForeign('reg_schema_property_element_ibfk_1');
			$table->dropForeign('reg_schema_property_element_ibfk_2');
			$table->dropForeign('reg_schema_property_element_ibfk_3');
			$table->dropForeign('reg_schema_property_element_ibfk_4');
			$table->dropForeign('reg_schema_property_element_ibfk_5');
			$table->dropForeign('reg_schema_property_element_ibfk_6');
		});
	}

}
