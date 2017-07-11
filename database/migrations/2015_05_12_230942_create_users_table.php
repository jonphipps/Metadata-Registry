<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */

/** @noinspection AutoloadingIssuesInspection */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->string('nickname', 60)->nullable();
                $table->string('salutation', 5)->nullable();
                $table->string('first_name', 125)->nullable();
                $table->string('last_name', 125)->nullable();
                $table->string('email', 100)->nullable();
                $table->boolean('is_administrator')->nullable()->default(0);
                $table->string('password')->nullable();
                $table->boolean('status')->default(1);
                $table->string('culture', 7)->nullable()->default('en_US');
                $table->string('confirmation_code')->nullable();
                $table->string('name')->default('');
                $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true);
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
        Schema::dropIfExists('users');
    }
}
