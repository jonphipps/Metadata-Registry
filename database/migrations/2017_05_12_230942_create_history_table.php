<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->default(0)->index();
			$table->integer('entity_id')->unsigned()->nullable();
			$table->string('icon')->nullable();
			$table->string('class')->nullable();
			$table->string('text')->nullable();
			$table->text('assets')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('history');
	}

}
