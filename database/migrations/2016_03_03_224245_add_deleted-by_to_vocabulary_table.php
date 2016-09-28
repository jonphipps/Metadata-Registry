<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDeletedByToVocabularyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_vocabulary',
            function (Blueprint $table) {
                $table->integer('deleted_user_id')->after('updated_user_id')->nullable()->index('deleted_user_id');
                $table->foreign('deleted_user_id', 'reg_vocabulary_ibfk_7')
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
        Schema::table('reg_vocabulary',
            function (Blueprint $table) {
                $table->dropForeign('reg_vocabulary_ibfk_7');
                $table->dropIndex('deleted_user_id');
                $table->dropColumn('deleted_user_id');

            });
    }
}
