<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile',
            function(Blueprint $table) {
                $table->foreign('status_id', 'profile_ibfk_2')->references('id')->on('reg_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
                $table->foreign('updated_by', 'profile_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('created_by', 'profile_ibfk_4')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('deleted_by', 'profile_ibfk_5')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('child_updated_by', 'profile_ibfk_6')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile',
            function(Blueprint $table) {
                $table->dropForeign('profile_ibfk_2');
                $table->dropForeign('profile_ibfk_3');
                $table->dropForeign('profile_ibfk_4');
                $table->dropForeign('profile_ibfk_5');
                $table->dropForeign('profile_ibfk_6');
            });
    }
}
