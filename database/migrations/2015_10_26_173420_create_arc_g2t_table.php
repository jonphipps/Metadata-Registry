<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArcG2tTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arc_g2t',
            function (Blueprint $table) {
                $table->integer('g')->unsigned()->index('g');
                $table->integer('t')->unsigned()->index('t');
                $table->unique([ 'g', 't' ], 'gt');
                $table->index([ 't', 'g' ], 'tg');
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arc_g2t');
    }

}
