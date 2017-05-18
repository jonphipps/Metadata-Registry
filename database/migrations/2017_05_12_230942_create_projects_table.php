<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('label')->nullable();
			$table->text('description')->nullable();
			$table->boolean('is_private')->nullable()->default(0);
			$table->timestamps();
			$table->softDeletes()->index();
			$table->string('repo')->nullable();
			$table->string('url')->nullable();
			$table->text('license')->nullable();
			$table->enum('uri_strategy', array('Numeric','snake_case','SCREAMING_SNAKE_CASE','hyphen-case','dot.case','camelCase','PascalCase'))->nullable();
			$table->enum('uri_type', array('Hash','Slash'))->nullable();
			$table->string('uri_prepend')->nullable();
			$table->string('uri_append')->nullable();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
			$table->integer('starting_number')->unsigned()->nullable();
			$table->string('license_uri')->nullable();
			$table->char('default_language',10)->nullable();
			$table->string('google_sheet_url')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
