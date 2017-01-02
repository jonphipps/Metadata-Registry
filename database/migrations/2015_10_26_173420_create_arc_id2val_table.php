<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateArcId2valTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arc_id2val',
            function (Blueprint $table) {
                $table->integer('id')->unsigned()->index('id_2');
                $table->boolean('misc')->default(0);
                $table->text('val');
                $table->boolean('val_type')->default(0);
                $table->unique([ 'id', 'val_type' ], 'id');
            });

      if (DB::getDriverName() == 'mysql') {
        DB::statement('CREATE INDEX v1 ON arc_id2val (val(64));');
      } else{
        DB::statement('CREATE INDEX v1 ON arc_id2val (val);');
      }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arc_id2val');
    }

}
