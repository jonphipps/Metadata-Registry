<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegSchemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_schema', function(Blueprint $table)
		{
			$table->foreign('created_user_id', 'reg_schema_ibfk_1')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('updated_user_id', 'reg_schema_ibfk_2')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('agent_id', 'reg_schema_ibfk_3')->references('id')->on('reg_agent')->onUpdate('NO ACTION')->onDelete('RESTRICT');
			$table->foreign('profile_id', 'reg_schema_ibfk_4')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'reg_schema_ibfk_5')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_schema', function(Blueprint $table)
		{
			$table->dropForeign('reg_schema_ibfk_1');
			$table->dropForeign('reg_schema_ibfk_2');
			$table->dropForeign('reg_schema_ibfk_3');
			$table->dropForeign('reg_schema_ibfk_4');
			$table->dropForeign('reg_schema_ibfk_5');
		});
	}

}
