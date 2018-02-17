<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToRegAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'reg_agent',
            function (Blueprint $table) {
                $table->foreign('created_by', 'reg_agent_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('updated_by', 'reg_agent_ibfk_2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('deleted_by', 'reg_agent_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
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
            'reg_agent',
            function (Blueprint $table) {
                $table->dropForeign('reg_agent_ibfk_1');
                $table->dropForeign('reg_agent_ibfk_2');
                $table->dropForeign('reg_agent_ibfk_3');
            }
        );
    }
}
