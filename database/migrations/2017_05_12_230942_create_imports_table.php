<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('source_file_name')->nullable();
			$table->enum('source', array('Google','upload'))->nullable();
			$table->timestamps();
			$table->softDeletes()->index();
			$table->text('map')->nullable();
			$table->integer('imported_by_id')->unsigned()->nullable()->index();
			$table->string('file_name')->nullable();
			$table->string('file_type')->nullable();
			$table->text('results')->nullable();
			$table->integer('total_processed_count')->unsigned()->nullable();
			$table->integer('error_count')->unsigned()->nullable();
			$table->integer('success_count')->unsigned()->nullable();
			$table->integer('batch_id')->unsigned()->nullable()->index();
			$table->integer('thing_collection_id')->unsigned()->nullable()->index();
			$table->integer('vocabulary_id')->unsigned()->nullable()->index();
			$table->integer('element_set_id')->unsigned()->nullable()->index();
			$table->integer('token')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imports');
	}

}
