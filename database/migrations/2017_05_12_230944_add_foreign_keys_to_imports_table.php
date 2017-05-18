<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToImportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('imports', function(Blueprint $table)
		{
			$table->foreign('imported_by', 'imports_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
			$table->foreign('user_id', 'imports_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign('vocabulary_id', 'imports_ibfk_3')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('schema_id', 'imports_ibfk_4')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('imports', function(Blueprint $table)
		{
			$table->dropForeign('imports_ibfk_1');
			$table->dropForeign('imports_ibfk_2');
			$table->dropForeign('imports_ibfk_3');
			$table->dropForeign('imports_ibfk_4');
		});
	}

}
