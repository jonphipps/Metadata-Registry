<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArcTripleTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('arc_triple',
        function (Blueprint $table) {
          $table->integer('t')->unsigned()->unique('t-t');
          $table->integer('s')->unsigned()->index('s-t');
          $table->integer('p')->unsigned()->index('p-t');
          $table->integer('o')->unsigned()->index('o-t');
          $table->integer('o_lang_dt')->unsigned()->index('o_lang_dt');
          $table->char('o_comp', 35);
          $table->boolean('s_type')->default(0);
          $table->boolean('o_type')->default(0);
          $table->boolean('misc')->default(0)->index('misc');
          $table->index([ 's', 'p', 'o' ], 'spo');
          $table->index([ 'o', 's' ], 'os');
          $table->index([ 'p', 'o' ], 'po');
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('arc_triple');
  }
}
