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

    Schema::create(config('admin.database.menu_table'),
        function (Blueprint $table) {
          $table->increments('id');
          $table->integer('parent_id')->default(0);
          $table->integer('order')->default(0);
          $table->string('title', 50);
          $table->string('icon', 50);
          $table->string('uri', 50);

          $table->timestamps();

        });
    Schema::create(config('admin.database.role_menu_table'),
        function (Blueprint $table) {
          $table->integer('role_id');
          $table->integer('menu_id');
          $table->index([ 'role_id', 'menu_id' ]);
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
    Schema::dropIfExists(config('admin.database.menu_table'));
    Schema::dropIfExists(config('admin.database.role_menu_table'));

  }
}
