<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegDiscussTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_discuss', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'reg_discuss_ibfk_1')->references('id')->on('reg_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('concept_property_id', 'reg_discuss_ibfk_10')->references('id')->on('reg_concept_property')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('deleted_user_id', 'reg_discuss_ibfk_2')->references('id')->on('reg_user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('schema_id', 'reg_discuss_ibfk_3')->references('id')->on('reg_schema')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('schema_property_id', 'reg_discuss_ibfk_4')->references('id')->on('reg_schema_property')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('schema_property_element_id', 'reg_discuss_ibfk_5')->references('id')->on('reg_schema_property_element')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('vocabulary_id', 'reg_discuss_ibfk_6')->references('id')->on('reg_vocabulary')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('concept_id', 'reg_discuss_ibfk_7')->references('id')->on('reg_concept')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('root_id', 'reg_discuss_ibfk_8')->references('id')->on('reg_discuss')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('parent_id', 'reg_discuss_ibfk_9')->references('id')->on('reg_discuss')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_discuss', function(Blueprint $table)
		{
			$table->dropForeign('reg_discuss_ibfk_1');
			$table->dropForeign('reg_discuss_ibfk_10');
			$table->dropForeign('reg_discuss_ibfk_2');
			$table->dropForeign('reg_discuss_ibfk_3');
			$table->dropForeign('reg_discuss_ibfk_4');
			$table->dropForeign('reg_discuss_ibfk_5');
			$table->dropForeign('reg_discuss_ibfk_6');
			$table->dropForeign('reg_discuss_ibfk_7');
			$table->dropForeign('reg_discuss_ibfk_8');
			$table->dropForeign('reg_discuss_ibfk_9');
		});
	}

}
