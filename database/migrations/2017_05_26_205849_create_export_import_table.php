<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateExportImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_import',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->unsignedInteger('import_id')->index();
                $table->foreign('import_id')
                    ->references('id')
                    ->on('reg_file_import_history')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');
                $table->unsignedInteger('export_id')->index();
                $table->foreign('export_id')
                    ->references('id')
                    ->on('reg_export_history')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('export_import',
            function(Blueprint $table) {
                $table->dropForeign('export_import_import_id_foreign');
                $table->dropForeign('export_import_export_id_foreign');
            });
        Schema::dropIfExists('export_import');
    }
}
