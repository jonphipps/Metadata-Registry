<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegConceptPropertyHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_concept_property_history',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->enum('action', [ 'updated', 'added', 'deleted', 'force_deleted' ])->nullable();
                $table->unsignedInteger('concept_property_id')->nullable()->index();
                $table->unsignedInteger('concept_id')->nullable()->index();
                $table->unsignedInteger('vocabulary_id')->nullable()->index();
                $table->unsignedInteger('skos_property_id')->nullable()->index();
                $table->mediumText('object')->nullable();
                $table->unsignedInteger('scheme_id')->nullable()->index();
                $table->unsignedInteger('related_concept_id')->nullable()->index();
                $table->char('language', 12)->nullable()->default('en')->comment('This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)');
                $table->unsignedInteger('status_id')->nullable()->default(1)->index();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->text('change_note')->nullable();
                $table->unsignedInteger('import_id')->nullable()->index();
                $table->unsignedInteger('profile_property_id')->nullable()->index();
                $table->unsignedInteger('created_by')->nullable()->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_concept_property_history');
    }
}
