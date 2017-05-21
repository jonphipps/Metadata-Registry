<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileProjectTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'profile_project',
            function( Blueprint $table ) {
                $table->integer( 'id', true );
                $table->integer( 'profile_id' )->unsigned()->nullable()->index( 'profile_project_' );
                $table->foreign( 'profile_id', 'profile_project_ibfk_1' )->references( 'id' )->on( 'profile' )->onUpdate( 'NO ACTION' )->onDelete( 'RESTRICT' );
                $table->integer( 'project_id' )->unsigned()->nullable()->index( 'profile_project_project_id' );
                $table->foreign( 'project_id', 'profile_project_ibfk_2' )->references( 'id' )->on( 'reg_agent' )->onUpdate( 'NO ACTION' )->onDelete( 'RESTRICT' );
                $table->timestamps();
                $table->softDeletes();
            } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table( 'profile_project',
            function( Blueprint $table ) {
                $table->dropForeign( 'profile_project_ibfk_1' );
                $table->dropForeign( 'profile_project_ibfk_2' );
            } );
        Schema::drop( 'profile_project' );
    }

}
