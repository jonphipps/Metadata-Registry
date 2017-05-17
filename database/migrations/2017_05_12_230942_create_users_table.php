<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->timestamp('last_updated')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('nickname', 60)->nullable();
			$table->string('salutation', 5)->nullable();
			$table->string('first_name', 125)->nullable();
			$table->string('last_name', 125)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('sha1_password', 40)->nullable();
			$table->string('salt', 32)->nullable();
			$table->boolean('want_to_be_moderator')->nullable()->default(0);
			$table->boolean('is_moderator')->nullable()->default(0);
			$table->boolean('is_administrator')->nullable()->default(0);
			$table->integer('deletions')->nullable()->default(0);
			$table->string('password')->nullable();
			$table->boolean('status')->default(1);
			$table->string('culture', 7)->nullable()->default('en_US');
			$table->string('confirmation_code')->default('');
			$table->string('name')->default('');
			$table->boolean('confirmed')->default(0);
			$table->string('remember_token', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
