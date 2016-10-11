<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAllConceptPropertyProfilePropertyIdFromSkosId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
'update reg_concept_property, profile_property
set reg_concept_property.profile_property_id = profile_property.id
where reg_concept_property.skos_property_id = profile_property.skos_id;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
