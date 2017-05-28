<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegSchemaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_schema', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('updated_user_id')->unsigned()->nullable()->index();
			$table->integer('deleted_user_id')->unsigned()->nullable()->index();
			$table->dateTime('child_updated_at')->nullable();
			$table->integer('child_updated_user_id')->unsigned()->nullable()->index();
            $table->integer('agent_id')->unsigned()->nullable()->index();
            $table->text('label')->nullable();
            $table->text('name')->nullable();
			$table->text('note')->nullable();
			$table->string('uri')->default('')->index();
			$table->string('url')->nullable();
			$table->string('base_domain')->default('');
			$table->string('token', 45)->default('');
			$table->string('community', 45)->nullable();
			$table->integer('last_uri_id')->unsigned()->nullable()->default(100000);
			$table->integer('status_id')->unsigned()->default(1)->index();
			$table->char('language', 6)->default('en');
			$table->integer('profile_id')->unsigned()->nullable()->index();
			$table->char('ns_type', 6)->default('slash');
			$table->text('prefixes')->nullable();
			$table->text('languages')->nullable();
			$table->string('repo')->nullable();
			$table->string('spreadsheet')->nullable();
			$table->string('worksheet')->nullable();
			$table->string('prefix')->default('');
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
		Schema::drop('reg_schema');
	}

}
