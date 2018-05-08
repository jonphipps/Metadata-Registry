<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReciprocalsToAttributeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_concept_property', function (Blueprint $table) {
            $table->boolean('review_reciprocal')->nullable();
            $table->unsignedInteger('reciprocal_concept_property_id')->nullable()->index();
            $table->foreign('reciprocal_concept_property_id', 'reg_concept_property_ibfk_14')
                ->references('id')
                ->on('reg_concept_property')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });

        Schema::table(
            'reg_schema_property_element',
            function (Blueprint $table) {
                $table->boolean('review_reciprocal')->nullable();
                $table->unsignedInteger('reciprocal_property_element_id')->nullable()->index();
                $table->foreign('reciprocal_property_element_id', 'reg_schema_property_element_ibfk_14')
                    ->references('id')
                    ->on('reg_schema_property_element')
                    ->onUpdate('NO ACTION')
                    ->onDelete('NO ACTION');
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
                $table->dropColumn('review_reciprocal');
                $table->dropForeign('reg_concept_property_ibfk_14');
                $table->dropIndex('reg_concept_property_reciprocal_concept_property_id_index');
                $table->dropColumn('reciprocal_concept_property_id');
            }
        );
        Schema::table(
            'reg_schema_property_element',
            function (Blueprint $table) {
                $table->dropColumn('review_reciprocal');
                $table->dropForeign('reg_schema_property_element_ibfk_14');
                $table->dropIndex('reg_schema_property_element_reciprocal_property_element_id_index');
                $table->dropColumn('reciprocal_property_element_id');
            }
        );
    }
}
