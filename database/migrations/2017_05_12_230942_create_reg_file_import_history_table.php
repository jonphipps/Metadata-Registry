<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegFileImportHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reg_file_import_history',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->string('source_file_name')->nullable();
                $table->enum('source', [ 'Google', 'upload' ])->nullable();
                $table->mediumText('map')->nullable()->comment('stores the serialized column map array');
                $table->unsignedInteger('user_id')->nullable()->index();
                $table->string('file_name')->nullable();
                $table->string('file_type')->nullable();
                $table->mediumText('preprocess')->nullable()->comment('stores the serialized results of the pre-import process');
                $table->mediumText('results')->nullable()->comment('stores the serialized results of the import');
                $table->timestamp('imported_at')->nullable();
                $table->unsignedInteger('total_processed_count')->nullable();
                $table->unsignedInteger('error_count')->nullable();
                $table->unsignedInteger('success_count')->nullable();
                $table->unsignedInteger('added_count')->nullable();
                $table->unsignedInteger('updated_count')->nullable();
                $table->unsignedInteger('deleted_count')->nullable();
                $table->unsignedInteger('batch_id')->nullable()->index();
                $table->unsignedInteger('vocabulary_id')->nullable()->index();
                $table->unsignedInteger('schema_id')->nullable()->index();
                $table->unsignedInteger('export_id')->nullable()->index();
                $table->integer('token')->nullable();
                $table->longText('instructions')->nullable();
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
        Schema::drop('reg_file_import_history');
    }
}
