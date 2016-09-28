<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSchemaHasVersionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('schema_has_version', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'schema_has_version_ibfk_1')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('schema_id', 'schema_has_version_ibfk_2')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('schema_has_version', function(Blueprint $table)
		{
			$table->dropForeign('schema_has_version_ibfk_1');
			$table->dropForeign('schema_has_version_ibfk_2');
		});
	}

}
