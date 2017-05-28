<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** @noinspection AutoloadingIssuesInspection */
class AddProjectUserFieldsToRegAgentHasUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table( 'reg_agent_has_user',
            function( Blueprint $table ) {
                $table->boolean( 'is_maintainer_for' )->nullable()->default( 1 );
                $table->text( 'languages' )->nullable();
                $table->char( 'default_language', 6 )->default( 'en' );
                $table->char( 'current_language', 6 )->nullable();
            } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
