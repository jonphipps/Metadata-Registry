<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileAndMapToExportHistory extends Migration
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
          $table->string('file')->nullable();
          $table->longText('map')->nullable();
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    // Schema::table('reg_export_history', function (Blueprint $table) {
    //     $table->dropColumn('file');
    //     $table->dropColumn('map');
    // });
  }
}
