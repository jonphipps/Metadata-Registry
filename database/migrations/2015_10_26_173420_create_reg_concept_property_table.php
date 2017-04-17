<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegConceptPropertyTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reg_concept_property',
        function (Blueprint $table) {
          $table->integer('id', true);
          $table->dateTime('created_at')->nullable();
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->dateTime('deleted_at')->nullable();
          $table->dateTime('last_updated')->nullable();
          $table->integer('created_user_id')->nullable()->index();
          $table->integer('updated_user_id')->nullable()->index();
          $table->integer('concept_id')->index();
          $table->boolean('primary_pref_label')->nullable();
          $table->integer('skos_property_id')->nullable()->index();
          $table->text('object')->default('')->nullable();
          $table->integer('scheme_id')->nullable()->index();
          $table->integer('related_concept_id')->nullable()->index();
          $table->char('language', 6)->nullable()->default('en');
          $table->integer('status_id')->nullable()->default(1)->index();
          $table->boolean('is_concept_property')->default(0);
          $table->boolean('is_generated')->default(0);
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('reg_concept_property');
  }
}
