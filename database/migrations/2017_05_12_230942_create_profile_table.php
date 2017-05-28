<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
			$table->dateTime('child_updated_at')->nullable();
			$table->integer('child_updated_by')->unsigned()->nullable()->index();
			$table->string('name')->default('');
			$table->text('note')->nullable();
			$table->string('uri')->default('');
			$table->string('url')->nullable();
			$table->string('base_domain')->default('');
			$table->string('token', 45)->default('');
			$table->string('community', 45)->nullable();
			$table->integer('last_uri_id')->unsigned()->nullable()->default(100000);
			$table->integer('status_id')->unsigned()->default(1)->index();
			$table->char('language', 6)->default('en');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profile');
	}

}
