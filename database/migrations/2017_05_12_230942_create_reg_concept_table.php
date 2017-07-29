<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
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
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('updated_user_id')->nullable()->index();
                $table->string('uri')->index();
                $table->text('lexical_alias')->nullable();
                $table->string('pref_label')->index();
                $table->unsignedInteger('vocabulary_id')->nullable()->index();
                $table->boolean('is_top_concept')->nullable();
                $table->unsignedInteger('pref_label_id')->nullable()->index();
                $table->unsignedInteger('status_id')->default(1)->index();
                $table->char('language', 12)->default('en');
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
                $table->unique([ 'vocabulary_id', 'pref_label', 'language' ], 'vocabulary_id_pref_label');
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
