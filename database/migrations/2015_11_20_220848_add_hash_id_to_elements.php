<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashIdToElements extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('reg_schema_property',
        function (Blueprint $table) {
          $table->char('hash_id', 255)->default('')->index('hash_id');
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('reg_schema_property',
        function (Blueprint $table) {
          $table->dropColumn('hash_id');
        });
  }
}
