<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegConceptTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_concept',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->dateTime('last_updated')->nullable();
                $table->integer('created_user_id')->nullable()->index('created_user_id');
                $table->integer('updated_user_id')->nullable()->index('last_updated_by_user_id');
                $table->string('uri')->default('')->index('reg_concept_idx1');
                $table->string('pref_label', 191)->default('')->index('pref_label');
                $table->integer('vocabulary_id')->nullable()->index('vocabulary_id');
                $table->boolean('is_top_concept')->nullable();
                $table->integer('pref_label_id')->nullable()->index('pref_label_id');
                $table->integer('status_id')->default(1)->index('status_id');
                $table->char('language', 6)->default('en');
                $table->unique([ 'vocabulary_id', 'pref_label' ], 'vocabulary_id_pref_label');
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_concept');
    }

}
