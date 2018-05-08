<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'role_user',
            function (Blueprint $table) {
                $table->foreign('role_id')->references('id')->on('roles')->onUpdate('NO ACTION')->onDelete('CASCADE');
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
            'role_user',
            function (Blueprint $table) {
                $table->dropForeign('role_user_role_id_foreign');
                $table->dropForeign('role_user_user_id_foreign');
            }
        );
    }
}
