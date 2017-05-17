<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->foreign('created_user_id', 'reg_collection_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_collection_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('vocabulary_id', 'reg_collection_ibfk_3')->references('id')->on('reg_vocabulary')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('status_id', 'reg_collection_ibfk_4')->references('id')->on('reg_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'reg_collection_ibfk_5')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('updated_by', 'reg_collection_ibfk_6')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('deleted_by', 'reg_collection_ibfk_7')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
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
			$table->dropForeign('reg_collection_ibfk_5');
			$table->dropForeign('reg_collection_ibfk_6');
			$table->dropForeign('reg_collection_ibfk_7');
		});
	}

}
