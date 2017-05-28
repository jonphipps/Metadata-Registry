<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegAgentHasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_agent_has_user',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->integer('user_id')->unsigned()->default(0);
                $table->integer('agent_id')->unsigned()->default(0);
                $table->boolean('is_registrar_for')->nullable()->default(1);
                $table->boolean('is_admin_for')->nullable()->default(1);
                $table->unique([ 'user_id', 'agent_id' ]);
                $table->unique([ 'agent_id', 'user_id' ]);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_agent_has_user');
    }
}
