<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_user', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('created_at')->nullable();
			$table->dateTime('deleted_at')->nullable();
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
			$table->string('password', 40)->nullable();
			$table->string('culture', 7)->nullable()->default('en_US');
            $table->rememberToken();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_user');
	}

}
