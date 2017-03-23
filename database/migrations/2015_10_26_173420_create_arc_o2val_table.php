<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
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
        Schema::create(
            'arc_o2val',
            function (Blueprint $table) {
                $table->integer('id')->unsigned()->unique('id-o');
                $table->integer('cid')->unsigned()->index('cid-o');
                $table->boolean('misc')->default(0);
                $table->text('val');
            }
        );
        if (DB::getDriverName() == 'mysql') {
            DB::statement('CREATE INDEX v2 ON arc_o2val (val(64));');
        } else {
            DB::statement('CREATE INDEX v2 ON arc_o2val (val);');
        }
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
