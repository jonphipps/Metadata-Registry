<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_export_history', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->nullable()->index('user_id');
            $table->integer('vocabulary_id')->nullable()->index('vocabulary_id');
            $table->integer('schema_id')->nullable()->index('schema_id');
            $table->string('csv_type', 100);
            $table->boolean('exclude_deprecated');
            $table->boolean('exclude_generated');
            $table->boolean('include_deleted');
            $table->text('selected_columns')->nullable();
            $table->string('selected_language', 10)->nullable();
            $table->string('published_english_version', 100)->nullable();
            $table->string('published_language_version', 100)->nullable();
            $table->timestamp('last_vocab_update')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_export_history');
    }
}
