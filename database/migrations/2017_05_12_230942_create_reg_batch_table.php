<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_batch',
            function(Blueprint $table) {
                $table->increments('id');
                $table->dateTime('run_time')->nullable();
                $table->text('run_description')->nullable();
                $table->string('object_type', 20)->nullable();
                $table->unsignedInteger('object_id')->nullable();
                $table->dateTime('event_time')->nullable();
                $table->string('event_type', 20)->nullable();
                $table->text('event_description')->nullable();
                $table->string('registry_uri')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_batch');
    }
}
