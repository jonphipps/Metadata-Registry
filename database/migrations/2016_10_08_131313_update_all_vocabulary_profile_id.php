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

      DB::statement('update reg_vocabulary set profile_id = 2;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
