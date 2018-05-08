<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToRegFileImportHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'reg_file_import_history',
            function (Blueprint $table) {
                $table->foreign('user_id', 'reg_file_import_history_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('vocabulary_id', 'reg_file_import_history_ibfk_2')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('NO ACTION');
                $table->foreign('schema_id', 'reg_file_import_history_ibfk_3')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('NO ACTION');
                $table->foreign('batch_id', 'reg_file_import_history_ibfk_4')->references('id')->on('reg_batch')->onUpdate('NO ACTION')->onDelete('CASCADE');
                $table->foreign('export_id', 'reg_file_import_history_ibfk_5')->references('id')->on('reg_export_history')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
        Schema::table(
            'reg_file_import_history',
            function (Blueprint $table) {
                $table->dropForeign('reg_file_import_history_ibfk_1');
                $table->dropForeign('reg_file_import_history_ibfk_2');
                $table->dropForeign('reg_file_import_history_ibfk_3');
                $table->dropForeign('reg_file_import_history_ibfk_4');
                $table->dropForeign('reg_file_import_history_ibfk_5');
            }
        );
    }
}
