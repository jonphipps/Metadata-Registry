<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
                $table->dateTime('child_updated_at')->nullable();
                $table->unsignedInteger('child_updated_by')->nullable()->index();
                $table->string('name')->default('');
                $table->text('note')->nullable();
                $table->string('uri')->default('');
                $table->string('url')->nullable();
                $table->string('base_domain')->default('');
                $table->string('token', 45)->default('');
                $table->string('community', 45)->nullable();
                $table->unsignedInteger('last_uri_id')->nullable()->default(100000);
                $table->unsignedInteger('status_id')->default(1)->index();
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
