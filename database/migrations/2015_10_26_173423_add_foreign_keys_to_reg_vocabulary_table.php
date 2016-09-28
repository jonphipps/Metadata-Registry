<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegVocabularyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_vocabulary', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'reg_vocabulary_ibfk_1')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_vocabulary_ibfk_2')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('child_updated_user_id', 'reg_vocabulary_ibfk_3')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('profile_id', 'reg_vocabulary_ibfk_4')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('agent_id', 'reg_vocabulary_ibfk_5')->references('id')->on('reg_agent')->onUpdate('NO ACTION')->onDelete('RESTRICT');
			$table->foreign('status_id', 'reg_vocabulary_ibfk_6')->references('id')->on('reg_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_vocabulary', function(Blueprint $table)
		{
			$table->dropForeign('reg_vocabulary_ibfk_1');
			$table->dropForeign('reg_vocabulary_ibfk_2');
			$table->dropForeign('reg_vocabulary_ibfk_3');
			$table->dropForeign('reg_vocabulary_ibfk_4');
			$table->dropForeign('reg_vocabulary_ibfk_5');
			$table->dropForeign('reg_vocabulary_ibfk_6');
		});
	}

}
