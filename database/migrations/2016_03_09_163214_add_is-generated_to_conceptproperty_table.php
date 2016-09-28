<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsGeneratedToConceptpropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_concept_property', function (Blueprint $table) {
            $table->boolean('is_generated')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_concept_property', function (Blueprint $table) {
            $table->dropColumn('is_generated');
        });
    }
}
