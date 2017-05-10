<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('exports', function(Blueprint $table)
		{
			$table->foreign('user_id', 'exports_ibfk_1')->references('id')->on('reg_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('vocabulary_id', 'exports_ibfk_2')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('schema_id', 'exports_ibfk_3')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('profile_id', 'exports_ibfk_4')->references('id')->on('profile')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('exports', function(Blueprint $table)
		{
			$table->dropForeign('exports_ibfk_1');
			$table->dropForeign('exports_ibfk_2');
			$table->dropForeign('exports_ibfk_3');
			$table->dropForeign('exports_ibfk_4');
		});
	}

}
