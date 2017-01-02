<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;

class AddPrefixToVocabulary extends Migration
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
                $table->string('prefix')->default('');
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
                $table->dropColumn('prefix');
            });
    }
}
