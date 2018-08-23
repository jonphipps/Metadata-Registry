<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenerateStatementsColumnToProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_agent', function (Blueprint $table) {
            $table->boolean('generate_statements')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_agent', function (Blueprint $table) {
            if (Schema::hasColumn('reg_agent', 'generate_statements')) {
                $table->dropColumn('generate_statements');
            }
        });
    }
}
