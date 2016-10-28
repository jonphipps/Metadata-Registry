<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;

class AddPrefixToSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_schema', function (Blueprint $table) {
          $table->string('prefix');
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
          $table->dropColumn('prefix');
        });
    }
}
