<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRegRdfNamespaceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reg_rdf_namespace', function(Blueprint $table)
		{
			$table->foreign('schema_id', 'reg_rdf_namespace_ibfk_1')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reg_rdf_namespace', function(Blueprint $table)
		{
			$table->dropForeign('reg_rdf_namespace_ibfk_1');
		});
	}

}
