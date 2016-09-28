<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegConceptPropertyHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_concept_property_history', function(Blueprint $table)
		{
			$table->foreign('skos_property_id', 'reg_concept_property_history_ibfk_1')->references('id')->on('reg_skos_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('import_id', 'reg_concept_property_history_ibfk_10')->references('id')->on('reg_file_import_history')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('scheme_id', 'reg_concept_property_history_ibfk_2')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('status_id', 'reg_concept_property_history_ibfk_3')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('related_concept_id', 'reg_concept_property_history_ibfk_4')->references('id')->on('reg_concept')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('created_user_id', 'reg_concept_property_history_ibfk_5')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('concept_property_id', 'reg_concept_property_history_ibfk_6')->references('id')->on('reg_concept_property')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('vocabulary_id', 'reg_concept_property_history_ibfk_7')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('concept_id', 'reg_concept_property_history_ibfk_8')->references('id')->on('reg_concept')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('import_id', 'reg_concept_property_history_ibfk_9')->references('id')->on('reg_file_import_history')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_concept_property_history', function(Blueprint $table)
		{
			$table->dropForeign('reg_concept_property_history_ibfk_1');
			$table->dropForeign('reg_concept_property_history_ibfk_10');
			$table->dropForeign('reg_concept_property_history_ibfk_2');
			$table->dropForeign('reg_concept_property_history_ibfk_3');
			$table->dropForeign('reg_concept_property_history_ibfk_4');
			$table->dropForeign('reg_concept_property_history_ibfk_5');
			$table->dropForeign('reg_concept_property_history_ibfk_6');
			$table->dropForeign('reg_concept_property_history_ibfk_7');
			$table->dropForeign('reg_concept_property_history_ibfk_8');
			$table->dropForeign('reg_concept_property_history_ibfk_9');
		});
	}

}
