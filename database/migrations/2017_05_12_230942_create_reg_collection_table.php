<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegCollectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_collection', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('last_updated')->nullable();
			$table->integer('created_user_id')->unsigned()->nullable()->index('');
			$table->integer('updated_user_id')->unsigned()->nullable()->index('');
			$table->integer('vocabulary_id')->unsigned()->nullable()->index('vocabulary_id');
			$table->string('name')->default('');
			$table->string('uri')->nullable();
			$table->string('pref_label')->default('');
			$table->integer('status_id')->unsigned()->default(1)->index();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_collection');
	}

}
