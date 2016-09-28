<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArcO2valTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arc_o2val',
            function (Blueprint $table) {
                $table->integer('id')->unsigned()->unique('id');
                $table->integer('cid')->unsigned()->index('cid');
                $table->boolean('misc')->default(0);
                $table->text('val');
            });
        DB::statement('CREATE INDEX v ON arc_o2val (val(64));');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arc_o2val');
    }

}
