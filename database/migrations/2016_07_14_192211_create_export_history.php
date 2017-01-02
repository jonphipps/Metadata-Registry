<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;

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
            $table->integer('user_id')->nullable()->index();
            $table->integer('vocabulary_id')->nullable()->index();
            $table->integer('schema_id')->nullable()->index();
            $table->string('csv_type', 100)->nullable();;
            $table->boolean('exclude_deprecated')->nullable();;
            $table->boolean('include_generated')->nullable();;
            $table->boolean('include_deleted')->nullable();;
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
