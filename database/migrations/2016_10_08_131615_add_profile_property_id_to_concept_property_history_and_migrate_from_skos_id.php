<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfilePropertyIdToConceptPropertyHistoryAndMigrateFromSkosId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_concept_property_history', function (Blueprint $table) {
            $table->integer('profile_property_id')->nullable()->index('reg_export_history_profile_property_id');
            $table->foreign('profile_property_id', 'reg_concept_property_element_history_ibfk_11')->references('id')
              ->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('reg_concept_property_history', function (Blueprint $table) {
        $table->dropForeign('reg_concept_property_element_history_ibfk_11');
        $table->dropColumn('profile_property_id');
      });
    }
}
