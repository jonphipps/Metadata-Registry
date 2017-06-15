<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** @noinspection AutoloadingIssuesInspection */
class AddProjectFieldsToBatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_batch', function (Blueprint $table) {
            $table->unsignedInteger('project_id')->nullable()->index();
            $table->foreign('project_id')->references('id')->on('reg_agent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_batch', function (Blueprint $table) {
            $table->dropForeign('reg_batch_project_id_foreign');
        });
    }
}
