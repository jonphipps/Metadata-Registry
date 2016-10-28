<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateArcS2valTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arc_s2val',
            function (Blueprint $table) {
                $table->integer('id')->unsigned()->unique('id');
                $table->integer('cid')->unsigned()->index('cid');
                $table->boolean('misc')->default(0);
                $table->text('val');
            });
        DB::statement('CREATE INDEX v ON arc_s2val (val(64));');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arc_s2val');
    }

}
