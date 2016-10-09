<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAllVocabularyProfileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      //todo: Update the vocabulary profile id to 2

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_vocabularies', function (Blueprint $table) {
            //
        });
    }
}
