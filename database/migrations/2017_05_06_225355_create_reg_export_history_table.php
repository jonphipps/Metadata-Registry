<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegExportHistoryTable extends Migration
{

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_export_history');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_export_history',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->integer('user_id')->nullable()->index('user_id');
                $table->integer('vocabulary_id')->nullable()->index('vocabulary_id');
                $table->integer('schema_id')->nullable()->index('schema_id');
                $table->boolean('exclude_deprecated')->nullable();
                $table->boolean('include_generated')->nullable();
                $table->boolean('include_deleted')->nullable();
                $table->boolean('include_not_accepted')->nullable();
                $table->text('selected_columns')->nullable();
                $table->string('selected_language', 10)->nullable();
                $table->string('published_english_version', 100)->nullable();
                $table->string('published_language_version', 100)->nullable();
                $table->dateTime('last_vocab_update')->nullable();
                $table->integer('profile_id')->nullable()->index('profile_id');
                $table->string('file')->nullable();
                $table->text('map')->nullable();
            });
    }

}
