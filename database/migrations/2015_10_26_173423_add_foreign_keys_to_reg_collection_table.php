<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_collection', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'reg_collection_ibfk_1')->references('id')->on('reg_user')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_collection_ibfk_2')->references('id')->on('reg_user')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('vocabulary_id', 'reg_collection_ibfk_3')->references('id')->on('reg_vocabulary')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('status_id', 'reg_collection_ibfk_4')->references('id')->on('reg_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_collection', function(Blueprint $table)
		{
			$table->dropForeign('reg_collection_ibfk_1');
			$table->dropForeign('reg_collection_ibfk_2');
			$table->dropForeign('reg_collection_ibfk_3');
			$table->dropForeign('reg_collection_ibfk_4');
		});
	}

}
