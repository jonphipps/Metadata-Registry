<?php
use Illuminate\Database\Migrations\Migration;

class UpdateVocabularyTableWithDefaultProfileId extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement('update reg_vocabulary set profile_id = 2;');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    //
  }
}
