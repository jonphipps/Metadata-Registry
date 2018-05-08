<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegExportHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reg_export_history',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->unsignedInteger('user_id')->nullable()->index();
                $table->unsignedInteger('vocabulary_id')->nullable()->index();
                $table->unsignedInteger('schema_id')->nullable()->index();
                $table->boolean('exclude_deprecated')->nullable();
                $table->boolean('include_generated')->nullable();
                $table->boolean('include_deleted')->nullable();
                $table->boolean('include_not_accepted')->nullable();
                $table->text('selected_columns')->nullable();
                $table->string('selected_language', 10)->nullable();
                $table->string('published_english_version', 100)->nullable();
                $table->string('published_language_version', 100)->nullable();
                $table->dateTime('last_vocab_update')->nullable();
                $table->unsignedInteger('profile_id')->nullable()->index();
                $table->string('file')->nullable();
                $table->mediumText('map')->nullable();
            }
        );
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
