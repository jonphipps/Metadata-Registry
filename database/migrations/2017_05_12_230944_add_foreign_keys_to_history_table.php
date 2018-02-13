<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'history',
            function (Blueprint $table) {
                $table->foreign('type_id')->references('id')->on('history_types')->onUpdate('RESTRICT')->onDelete('CASCADE');
                $table->foreign('user_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
            'history',
            function (Blueprint $table) {
                $table->dropForeign('history_type_id_foreign');
                $table->dropForeign('history_user_id_foreign');
            }
        );
    }
}
