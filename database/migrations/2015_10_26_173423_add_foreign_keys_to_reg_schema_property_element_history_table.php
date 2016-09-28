<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegSchemaPropertyElementHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_schema_property_element_history', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'reg_schema_property_element_history_ibfk_1')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('schema_property_element_id', 'reg_schema_property_element_history_ibfk_2')->references('id')->on('reg_schema_property_element')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('schema_property_id', 'reg_schema_property_element_history_ibfk_3')->references('id')->on('reg_schema_property')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('schema_id', 'reg_schema_property_element_history_ibfk_4')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('related_schema_property_id', 'reg_schema_property_element_history_ibfk_5')->references('id')->on('reg_schema_property')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('status_id', 'reg_schema_property_element_history_ibfk_6')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('profile_property_id', 'reg_schema_property_element_history_ibfk_7')->references('id')->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('import_id', 'reg_schema_property_element_history_ibfk_8')->references('id')->on('reg_file_import_history')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_schema_property_element_history', function(Blueprint $table)
		{
			$table->dropForeign('reg_schema_property_element_history_ibfk_1');
			$table->dropForeign('reg_schema_property_element_history_ibfk_2');
			$table->dropForeign('reg_schema_property_element_history_ibfk_3');
			$table->dropForeign('reg_schema_property_element_history_ibfk_4');
			$table->dropForeign('reg_schema_property_element_history_ibfk_5');
			$table->dropForeign('reg_schema_property_element_history_ibfk_6');
			$table->dropForeign('reg_schema_property_element_history_ibfk_7');
			$table->dropForeign('reg_schema_property_element_history_ibfk_8');
		});
	}

}
