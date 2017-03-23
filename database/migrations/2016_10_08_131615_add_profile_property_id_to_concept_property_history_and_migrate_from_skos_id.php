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
      /** @var \Illuminate\Database\Schema\MySqlBuilder Schema */
        Schema::table(
            'reg_concept_property_history',
            function (Blueprint $table) {
                $table->integer('profile_property_id')->nullable()->index('reg_export_history_profile_property_id');
                $table->foreign('profile_property_id', 'reg_concept_property_history_ibfk_11')->references('id')
                ->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            }
        );

        if (DB::getDriverName() == 'mysql') {
            DB::statement('update reg_concept_property_history, profile_property
set reg_concept_property_history.profile_property_id = profile_property.id
where reg_concept_property_history.skos_property_id = profile_property.skos_id');
        }
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_concept_property_history', function (Blueprint $table) {
            $table->dropForeign('reg_concept_property_history_ibfk_11');
            $table->dropColumn('profile_property_id');
        });
    }
}
