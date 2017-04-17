<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegLookupTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reg_lookup',
        function (Blueprint $table) {
          $table->integer('id', true);
          $table->integer('type_id')->nullable();
          $table->char('short_value', 20)->nullable();
          $table->string('long_value')->nullable();
          $table->integer('display_order')->nullable();
          $table->index([ 'type_id', 'display_order' ], 'display_order');
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('reg_lookup');
  }
}
