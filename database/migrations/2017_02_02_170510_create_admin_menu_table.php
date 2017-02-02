<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenuTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('admin_menu',
        function (Blueprint $table) {
          $table->increments('id');
          $table->integer('parent_id')->default(0);
          $table->integer('order')->default(0);
          $table->string('title', 50);
          $table->string('icon', 50);
          $table->string('uri', 50);

          $table->timestamps();

        });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('admin_menu');
  }
}
