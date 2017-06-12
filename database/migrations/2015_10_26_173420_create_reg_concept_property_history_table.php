<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
                $table->integer('id', true);
                $table->timestamp('created_at')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->index('reg_concept_property_history_idx1');
                $table->enum('action', [ 'updated', 'added', 'deleted', 'force_deleted' ])->nullable();
                $table->integer('concept_property_id')->nullable()->index('concept_property_id');
                $table->integer('concept_id')->nullable()->index('concept_id');
                $table->integer('vocabulary_id')->nullable()->index();
                $table->integer('skos_property_id')->nullable()->index('skos_property_id');
                $table->text('object')->nullable();
                $table->integer('scheme_id')->nullable()->index('scheme_id');
                $table->integer('related_concept_id')->nullable()->index('related_concept_id');
                $table->char('language', 6)->nullable()->default('en');
                $table->integer('status_id')->nullable()->default(1)->index();
                $table->integer('created_user_id')->nullable()->index();
                $table->text('change_note')->nullable();
                $table->integer('import_id')->nullable()->index('import_id');
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
