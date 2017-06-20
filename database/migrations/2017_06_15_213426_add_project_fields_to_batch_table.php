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
            $table->timestamps();
            $table->unsignedInteger('project_id')->nullable()->index();
            $table->foreign('project_id')->references('id')->on('reg_agent')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->unsignedInteger('user_id')->nullable()->index();
            $table->foreign('user_id' )->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->string('next_step')->nullable();
            $table->mediumText('step_data')->nullable();
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
            $table->dropForeign('reg_batch_user_id_foreign');
            $table->dropColumn('project_id');
            $table->dropColumn('next_step');
            $table->dropColumn('step_data');
            $table->dropTimestamps();
        });
    }
}
