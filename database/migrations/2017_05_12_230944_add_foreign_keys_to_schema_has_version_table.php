<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToSchemaHasVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'schema_has_version',
            function (Blueprint $table) {
                $table->foreign('created_user_id', 'schema_has_version_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
                $table->foreign('schema_id', 'schema_has_version_ibfk_2')->references('id')->on('reg_schema')->onUpdate('NO ACTION')->onDelete('CASCADE');
                $table->foreign('created_by', 'schema_has_version_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            'schema_has_version',
            function (Blueprint $table) {
                $table->dropForeign('schema_has_version_ibfk_1');
                $table->dropForeign('schema_has_version_ibfk_2');
                $table->dropForeign('schema_has_version_ibfk_3');
            }
        );
    }
}
