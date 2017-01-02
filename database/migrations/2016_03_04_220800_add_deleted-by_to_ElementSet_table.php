<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;

class AddDeletedByToElementSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_schema', function (Blueprint $table) {
            $table->integer('deleted_user_id')->after('updated_user_id')->nullable()->index();
            $table->foreign('deleted_user_id', 'reg_schema_ibfk_6')
                  ->references('id')
                  ->on('reg_user')
                  ->onUpdate('NO ACTION')
                  ->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_schema', function (Blueprint $table) {
            $table->dropForeign('reg_schema_ibfk_6');
            $table->dropColumn('deleted_user_id');
        });
    }
}
