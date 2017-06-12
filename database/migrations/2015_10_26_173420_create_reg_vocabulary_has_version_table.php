<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegVocabularyHasVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_vocabulary_has_version',
            function(Blueprint $table) {
                $table->integer('id', true);
                $table->string('name')->default('')->index('name');
                $table->dateTime('created_at')->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->integer('created_user_id')->nullable()->index();
                $table->integer('vocabulary_id')->nullable()->index();
                $table->dateTime('timeslice')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_vocabulary_has_version');
    }
}
