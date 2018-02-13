<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateSchemaHasVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'schema_has_version',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->default('');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('schema_id')->nullable()->index();
                $table->dateTime('timeslice')->nullable();
                $table->unsignedInteger('created_by')->nullable()->index();
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
        Schema::drop('schema_has_version');
    }
}
