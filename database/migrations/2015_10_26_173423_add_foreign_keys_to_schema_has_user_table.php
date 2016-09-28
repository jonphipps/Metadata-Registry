<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSchemaHasUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schema_has_user', function(Blueprint $table)
		{
			$table->foreign('schema_id', 'schema_has_user_ibfk_1')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('CASCADE');
			$table->foreign('user_id', 'schema_has_user_ibfk_2')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schema_has_user', function(Blueprint $table)
		{
			$table->dropForeign('schema_has_user_ibfk_1');
			$table->dropForeign('schema_has_user_ibfk_2');
		});
	}

}
