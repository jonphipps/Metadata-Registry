<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchemaHasVersionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schema_has_version', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('schema_id')->unsigned()->nullable()->index();
			$table->dateTime('timeslice')->nullable();
			$table->integer('created_by')->unsigned()->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('schema_has_version');
	}

}
