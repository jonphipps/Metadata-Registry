<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCompoundIndexToSchemauserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schema_has_user',
            function (Blueprint $table) {
                $table->unique([ 'schema_id', 'user_id' ], 'schema_user');
                $table->index([ 'user_id', 'schema_id' ], 'user_schema');
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schema_has_user',
            function (Blueprint $table) {
                $table->dropUnique('schema_user');
                $table->dropIndex('user_schema');
            });
    }
}
