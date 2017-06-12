<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivateAndRepoToAgents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_agent',
            function(Blueprint $table) {
                $table->string('repo')->nullable();
                $table->boolean('is_private')->default(false);
                $table->string('license')->nullable();
                $table->text('description')->nullable();
                $table->integer('created_by')->nullable()->index('created_by');
                $table->integer('updated_by')->nullable()->index('updated_by');
                $table->integer('deleted_by')->nullable()->index('deleted_by');
                $table->foreign('created_by', 'reg_agent_ibfk_1')
                    ->references('id')
                    ->on('reg_user')
                    ->onUpdate('NO ACTION')
                    ->onDelete('SET NULL');
                $table->foreign('updated_by', 'reg_agent_ibfk_2')
                    ->references('id')
                    ->on('reg_user')
                    ->onUpdate('NO ACTION')
                    ->onDelete('SET NULL');
                $table->foreign('deleted_by', 'reg_agent_ibfk_3')
                    ->references('id')
                    ->on('reg_user')
                    ->onUpdate('NO ACTION')
                    ->onDelete('SET NULL');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_agent',
            function(Blueprint $table) {
                $table->dropColumn('repo');
                $table->dropColumn('is_private');
                $table->dropColumn('license');
                $table->dropColumn('description');
            });
    }
}
