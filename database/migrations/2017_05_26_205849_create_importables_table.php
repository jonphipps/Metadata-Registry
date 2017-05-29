<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateImportablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('importables',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->morphs('importable');
                $table->unsignedInteger('import_id')->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importables');
    }
}
