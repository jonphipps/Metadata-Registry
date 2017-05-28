<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddForeignKeysToRegVocabularyHasVersionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_vocabulary_has_version',
            function(Blueprint $table) {
                $table->foreign('created_user_id', 'reg_vocabulary_has_version_ibfk_1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
                $table->foreign('vocabulary_id', 'reg_vocabulary_has_version_ibfk_2')->references('id')->on('reg_vocabulary')->onUpdate('NO ACTION')->onDelete('CASCADE');
                $table->foreign('created_by', 'reg_vocabulary_has_version_ibfk_3')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('SET NULL');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_vocabulary_has_version',
            function(Blueprint $table) {
                $table->dropForeign('reg_vocabulary_has_version_ibfk_1');
                $table->dropForeign('reg_vocabulary_has_version_ibfk_2');
                $table->dropForeign('reg_vocabulary_has_version_ibfk_3');
            });
    }
}
