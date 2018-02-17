<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateSocialLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'social_logins',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->nullable()->index();
                $table->string('provider', 32);
                $table->string('provider_id')->nullable();
                $table->string('token')->nullable();
                $table->string('avatar')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_logins');
    }
}
