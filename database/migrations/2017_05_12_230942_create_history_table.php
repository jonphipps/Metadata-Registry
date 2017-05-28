<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history',
            function(Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('type_id')->index();
                $table->unsignedInteger('user_id')->default(0)->index();
                $table->unsignedInteger('entity_id')->nullable();
                $table->string('icon')->nullable();
                $table->string('class')->nullable();
                $table->string('text')->nullable();
                $table->text('assets')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('history');
    }
}
