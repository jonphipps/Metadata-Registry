<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned()->nullable()->index();
			$table->integer('vocabulary_id')->unsigned()->nullable()->index();
			$table->integer('schema_id')->unsigned()->nullable()->index();
			$table->boolean('exclude_deprecated')->nullable()->default(1);
			$table->boolean('include_generated')->nullable()->default(1);
			$table->boolean('include_deleted')->nullable()->default(1);
			$table->boolean('include_not_accepted')->nullable()->default(0);
			$table->text('selected_columns')->nullable();
			$table->string('selected_language', 10)->nullable();
			$table->string('published_english_version', 100)->nullable();
			$table->string('published_language_version', 100)->nullable();
			$table->dateTime('last_vocab_update')->nullable();
			$table->integer('profile_id')->unsigned()->nullable()->index();
			$table->integer('exported_by')->unsigned()->nullable()->index();
			$table->string('file')->nullable();
			$table->mediumText('map')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exports');
	}

}
