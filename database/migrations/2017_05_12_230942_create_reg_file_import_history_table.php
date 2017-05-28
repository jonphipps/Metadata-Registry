<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegFileImportHistoryTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'reg_file_import_history',
            function( Blueprint $table ) {
                $table->increments( 'id' );
                $table->timestamps();
                $table->string( 'source_file_name' )->nullable();
                $table->enum( 'source',
                    [ 'Google', 'upload' ] )->nullable();
                $table->mediumText( 'map' )->nullable()->comment( 'stores the serialized column map array' );
                $table->integer( 'user_id' )->unsigned()->nullable()->index();
                $table->string( 'file_name' )->nullable();
                $table->string( 'file_type' )->nullable();
                $table->mediumText( 'results' )->nullable()->comment( 'stores the serialized results of the import' );
                $table->integer( 'total_processed_count' )->unsigned()->nullable();
                $table->integer( 'error_count' )->unsigned()->nullable();
                $table->integer( 'success_count' )->unsigned()->nullable();
                $table->integer( 'batch_id' )->unsigned()->nullable()->index();
                $table->integer( 'vocabulary_id' )->unsigned()->nullable()->index();
                $table->integer( 'schema_id' )->unsigned()->nullable()->index();
                $table->integer( 'token' )->nullable();
            } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'reg_file_import_history' );
    }

}
