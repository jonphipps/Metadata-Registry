<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('languages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('app_name', 100);
			$table->string('flag', 100)->nullable();
			$table->string('abbr', 3);
			$table->string('script', 20)->nullable();
			$table->string('native', 20)->nullable();
			$table->boolean('active')->default(1);
			$table->boolean('default')->default(0);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('languages');
	}

}
