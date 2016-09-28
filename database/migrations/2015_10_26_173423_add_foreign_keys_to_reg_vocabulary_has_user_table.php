<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegVocabularyHasUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_vocabulary_has_user', function(Blueprint $table)
		{
			$table->foreign('user_id', 'reg_vocabulary_has_user_ibfk_1')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('vocabulary_id', 'reg_vocabulary_has_user_ibfk_2')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_vocabulary_has_user', function(Blueprint $table)
		{
			$table->dropForeign('reg_vocabulary_has_user_ibfk_1');
			$table->dropForeign('reg_vocabulary_has_user_ibfk_2');
		});
	}

}
