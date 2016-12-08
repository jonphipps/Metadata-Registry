<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegPrefixTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_prefix',
            function (Blueprint $table) {
                $table->string('prefix', 40)->primary();
                $table->string('uri', 256)->nullable()->index('prefix_uri');
                $table->integer('rank')->nullable()->default(0)->index('prefix_rank');
            });
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
