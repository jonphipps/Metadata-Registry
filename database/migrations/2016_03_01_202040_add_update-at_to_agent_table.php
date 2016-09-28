<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateAtToAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_agent',
            function (Blueprint $table) {
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->after('created_at');
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_agent',
            function (Blueprint $table) {
                $table->dropColumn('updated_at');
            });
    }
}
