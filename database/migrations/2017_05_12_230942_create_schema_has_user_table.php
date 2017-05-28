<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateSchemaHasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schema_has_user',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('schema_id')->default(0)->index();
                $table->unsignedInteger('user_id')->default(0)->index();
                $table->boolean('is_maintainer_for')->nullable()->default(1);
                $table->boolean('is_registrar_for')->nullable()->default(1);
                $table->boolean('is_admin_for')->nullable()->default(1);
                $table->text('languages')->nullable();
                $table->char('default_language', 6)->default('en');
                $table->char('current_language', 6)->nullable();
                $table->unique([ 'schema_id', 'user_id' ], 'schema_user');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schema_has_user');
    }
}
