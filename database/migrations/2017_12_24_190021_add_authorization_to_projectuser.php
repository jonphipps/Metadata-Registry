<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorizationToProjectuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_agent_has_user', function (Blueprint $table) {
            $table->tinyInteger('authorized_as')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_agent_has_user', function (Blueprint $table) {
            $table->dropColumn('authorized_as');
        });
    }
}
