<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->integer('user_id')->default(0);
                $table->integer('agent_id')->default(0);
                $table->boolean('is_registrar_for')->nullable()->default(1);
                $table->boolean('is_admin_for')->nullable()->default(1);
                $table->unique([ 'user_id', 'agent_id' ], 'user_agent_id');
                $table->unique([ 'agent_id', 'user_id' ], 'agent_user_id');
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
