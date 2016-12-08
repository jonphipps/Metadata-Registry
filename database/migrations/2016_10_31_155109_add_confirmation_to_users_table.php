<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmationToUsersTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('reg_user',
        function (Blueprint $table) {
          $table->string('confirmation_code');
          $table->string('name', 191);
          $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true);
          $table->boolean('status')->default(true);
        });
    //set a random unique confirmation code
    DB::statement('update reg_user set confirmation_code = md5(SYSDATE(6));');
    DB::statement('update reg_user set name = nickname;');
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('reg_user',
        function (Blueprint $table) {
          $table->dropColumn([ 'confirmation_code', 'confirmed', 'name', 'status' ]);
        });
  }
}
