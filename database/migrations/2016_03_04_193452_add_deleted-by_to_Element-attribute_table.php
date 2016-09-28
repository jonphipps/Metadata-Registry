<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedByToElementAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_schema_property_element', function (Blueprint $table) {
            $table->integer('deleted_user_id')->after('updated_user_id')->nullable()->index('deleted_user_id');
            $table->foreign('deleted_user_id', 'reg_schema_property_element_ibfk_7')
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
        Schema::table('reg_schema_property_element', function (Blueprint $table) {
            $table->dropForeign('reg_schema_property_element_ibfk_7');
            $table->dropIndex('deleted_user_id');
            $table->dropColumn('deleted_user_id');
        });
    }
}
