<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->foreign('created_user_id', 'reg_vocabulary_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('child_updated_by', 'reg_vocabulary_ibfk_10')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('deleted_by', 'reg_vocabulary_ibfk_11')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_vocabulary_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('child_updated_user_id', 'reg_vocabulary_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('profile_id', 'reg_vocabulary_ibfk_4')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('project_id', 'reg_vocabulary_ibfk_5')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('RESTRICT');
			$table->foreign('agent_id', 'reg_vocabulary_ibfk_14')->references('id')->on('projects')->onUpdate('NO ACTION')->onDelete('RESTRICT');
			$table->foreign('status_id', 'reg_vocabulary_ibfk_6')->references('id')->on('reg_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('deleted_user_id', 'reg_vocabulary_ibfk_7')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('created_by', 'reg_vocabulary_ibfk_8')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_by', 'reg_vocabulary_ibfk_9')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign('deleted_by', 'reg_vocabulary_ibfk_13')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
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
			$table->dropForeign('reg_vocabulary_ibfk_10');
			$table->dropForeign('reg_vocabulary_ibfk_11');
			$table->dropForeign('reg_vocabulary_ibfk_2');
			$table->dropForeign('reg_vocabulary_ibfk_3');
			$table->dropForeign('reg_vocabulary_ibfk_4');
			$table->dropForeign('reg_vocabulary_ibfk_5');
			$table->dropForeign('reg_vocabulary_ibfk_6');
			$table->dropForeign('reg_vocabulary_ibfk_7');
			$table->dropForeign('reg_vocabulary_ibfk_8');
			$table->dropForeign('reg_vocabulary_ibfk_9');
		});
	}

}
