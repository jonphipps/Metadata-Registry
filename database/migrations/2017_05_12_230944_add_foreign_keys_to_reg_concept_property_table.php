<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToRegConceptPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'reg_concept_property',
            function (Blueprint $table) {
                $table->foreign('created_user_id', 'reg_concept_property_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('profile_property_id', 'reg_concept_property_ibfk_10')->references('id')->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
                $table->foreign('created_by', 'reg_concept_property_ibfk_11')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('updated_by', 'reg_concept_property_ibfk_12')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('deleted_by', 'reg_concept_property_ibfk_13')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('updated_user_id', 'reg_concept_property_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('concept_id', 'reg_concept_property_ibfk_3')->references('id')->on('reg_concept')->onUpdate('NO ACTION')->onDelete('CASCADE');
                $table->foreign('skos_property_id', 'reg_concept_property_ibfk_4')->references('skos_id')->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
                $table->foreign('scheme_id', 'reg_concept_property_ibfk_5')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('status_id', 'reg_concept_property_ibfk_6')->references('id')->on('reg_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
                $table->foreign('related_concept_id', 'reg_concept_property_ibfk_7')->references('id')->on('reg_concept')->onUpdate('NO ACTION')->onDelete('SET NULL');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'reg_concept_property',
            function (Blueprint $table) {
                $table->dropForeign('reg_concept_property_ibfk_1');
                $table->dropForeign('reg_concept_property_ibfk_10');
                $table->dropForeign('reg_concept_property_ibfk_11');
                $table->dropForeign('reg_concept_property_ibfk_12');
                $table->dropForeign('reg_concept_property_ibfk_13');
                $table->dropForeign('reg_concept_property_ibfk_2');
                $table->dropForeign('reg_concept_property_ibfk_3');
                $table->dropForeign('reg_concept_property_ibfk_4');
                $table->dropForeign('reg_concept_property_ibfk_5');
                $table->dropForeign('reg_concept_property_ibfk_6');
                $table->dropForeign('reg_concept_property_ibfk_7');
            }
        );
    }
}
