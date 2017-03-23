<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;

class AddUpdateAtToAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'reg_agent',
            function (Blueprint $table) {
                $default = DB::getDriverName() == 'mysql' ? DB::raw('CURRENT_TIMESTAMP') : '';
                $table->timestamp('updated_at')->default($default)->after('created_at');
            }
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'reg_agent',
            function (Blueprint $table) {
                $table->dropColumn('updated_at');
            }
        );
    }
}
