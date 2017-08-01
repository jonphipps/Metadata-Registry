<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
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
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('updated_user_id')->nullable()->index();
                $table->unsignedInteger('concept_id')->index();
                $table->boolean('primary_pref_label')->nullable();
                $table->unsignedInteger('skos_property_id')->nullable()->index();
                $table->mediumText('object')->nullable();
                $table->unsignedInteger('scheme_id')->nullable()->index();
                $table->unsignedInteger('related_concept_id')->nullable()->index();
                $table->char('language', 12)->nullable()->default('en');
                $table->unsignedInteger('status_id')->nullable()->default(1)->index();
                $table->boolean('is_concept_property')->default(0);
                $table->unsignedInteger('profile_property_id')->nullable()->index();
                $table->unsignedInteger('last_import_id')->nullable()->index();
                $table->boolean('is_generated')->default(0);
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
            });
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE reg_concept_property ADD FULLTEXT full( `object`)');
        }
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
