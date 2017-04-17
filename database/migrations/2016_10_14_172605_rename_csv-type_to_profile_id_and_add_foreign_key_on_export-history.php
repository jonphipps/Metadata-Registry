<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCsvTypeToProfileIdAndAddForeignKeyOnExportHistory extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('reg_export_history',
        function (Blueprint $table) {
          $table->dropColumn('csv_type');
          $table->integer('profile_id')->nullable()->index();
          $table->foreign('profile_id', 'reg_export_history_ibfk_4')
              ->references('id')
              ->on('profile')
              ->onUpdate('NO ACTION')
              ->onDelete('NO ACTION');
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('reg_export_history',
        function (Blueprint $table) {
          $table->dropForeign('reg_export_history_ibfk_4');
        });
  }
}
