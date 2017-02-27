<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedAtToVoabularyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('reg_vocabulary',
        function (Blueprint $table) {
          $table->timestamp('updated_at')
               ->nullable();
        });
    \DB::statement('update reg_vocabulary set updated_at = last_updated;');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('reg_vocabulary',
        function (Blueprint $table) {
          $table->dropColumn('updated_at');
        });
  }

}
