<?php
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
    if (DB::getDriverName() == 'mysql') {
      DB::statement('update reg_concept_property, profile_property
set reg_concept_property.profile_property_id = profile_property.id
where reg_concept_property.skos_property_id = profile_property.skos_id;');
    }
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
