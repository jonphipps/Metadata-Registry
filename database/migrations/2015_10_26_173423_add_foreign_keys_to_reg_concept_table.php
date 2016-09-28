<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegConceptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_concept', function(Blueprint $table)
		{
			$table->foreign('vocabulary_id', 'reg_concept_ibfk_1')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('created_user_id', 'reg_concept_ibfk_2')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('pref_label_id', 'reg_concept_ibfk_3')->references('id')->on('reg_concept_property')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_concept_ibfk_4')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('status_id', 'reg_concept_ibfk_5')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_concept', function(Blueprint $table)
		{
			$table->dropForeign('reg_concept_ibfk_1');
			$table->dropForeign('reg_concept_ibfk_2');
			$table->dropForeign('reg_concept_ibfk_3');
			$table->dropForeign('reg_concept_ibfk_4');
			$table->dropForeign('reg_concept_ibfk_5');
		});
	}

}
