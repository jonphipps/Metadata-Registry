<?php

use Illuminate\Database\Migrations\Migration;

class UpdateVocabularyTableWithDefaultProfileId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('UPDATE reg_vocabulary SET profile_id = 2;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
