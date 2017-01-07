<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddProfilePropertyIdToConceptPropertyTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('reg_concept_property',
        function (Blueprint $table) {
          $table->integer('profile_property_id')->nullable()->index('profile_property_id');
          $table->foreign('profile_property_id', 'reg_concept_property_ibfk_10')
                ->references('id')
                ->on('profile_property')
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
    Schema::table('reg_concept_property',
        function (Blueprint $table) {
          $table->dropForeign('reg_concept_property_ibfk_10');
          $table->dropIndex('profile_property_id');
          $table->dropColumn('profile_property_id');

        });
  }
}
