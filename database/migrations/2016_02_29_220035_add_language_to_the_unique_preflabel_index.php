<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLanguageToTheUniquePreflabelIndex extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_concept', function (Blueprint $table) {
            $table->dropIndex('vocabulary_id_pref_label');
            $table->unique([ 'vocabulary_id', 'pref_label', 'language' ], 'vocabulary_id_pref_label');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_concept',
            function (Blueprint $table) {
                $table->dropIndex('vocabulary_id_pref_label');
                $table->unique([ 'vocabulary_id', 'pref_label' ], 'vocabulary_id_pref_label');
            });
    }
}
