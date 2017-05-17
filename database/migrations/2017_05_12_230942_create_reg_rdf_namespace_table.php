<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegRdfNamespaceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_rdf_namespace', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('schema_id')->unsigned()->index();
			$table->integer('created_user_id')->unsigned()->nullable();
			$table->integer('updated_user_id')->unsigned()->nullable();
			$table->string('token')->default('');
			$table->text('note')->nullable();
			$table->string('uri')->default('');
			$table->string('schema_location')->nullable();
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
			$table->integer('deleted_by')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_rdf_namespace');
	}

}
