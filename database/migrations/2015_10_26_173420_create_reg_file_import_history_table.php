<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegFileImportHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_file_import_history', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->text('map')->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->integer('vocabulary_id')->nullable()->index('vocabulary_id');
			$table->integer('schema_id')->nullable()->index('schema_id');
			$table->string('file_name')->nullable();
			$table->string('source_file_name')->nullable();
			$table->string('file_type', 30)->nullable();
			$table->integer('batch_id')->nullable()->index('batch_id');
			$table->text('results')->nullable();
			$table->integer('total_processed_count')->nullable();
			$table->integer('error_count')->nullable();
			$table->integer('success_count')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_file_import_history');
	}

}
