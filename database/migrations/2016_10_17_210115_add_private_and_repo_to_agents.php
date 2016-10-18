<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivateAndRepoToAgents extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('reg_agent',
        function (Blueprint $table) {
          $table->string('repo')->nullable();
          $table->boolean('is_private')->default(false);
        });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('reg_agent',
        function (Blueprint $table) {
          $table->dropColumn('repo');
          $table->dropColumn('is_private');
        });
  }
}
