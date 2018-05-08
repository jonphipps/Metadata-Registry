<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegPrefixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reg_prefix',
            function (Blueprint $table) {
                $table->string('prefix', 40)->primary();
                $table->string('uri')->nullable()->index();
                $table->integer('rank')->nullable()->default(0)->index();
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
        Schema::drop('reg_prefix');
    }
}
