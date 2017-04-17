<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
          $table->integer('id')->unsigned()->unique('id-s');
          $table->integer('cid')->unsigned()->index('cid-s');
          $table->boolean('misc')->default(0);
          $table->text('val');
        });
    if (DB::getDriverName() == 'mysql') {
      DB::statement('CREATE INDEX v3 ON arc_s2val (val(64));');
    } else {
      DB::statement('CREATE INDEX v3 ON arc_s2val (val);');
    }
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
