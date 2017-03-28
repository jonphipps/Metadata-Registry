<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddUpdateAtToUserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'reg_user',
            function (Blueprint $table) {
                $table->datetime('updated_at')->after('created_at')->nullable();
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
            'reg_user',
            function (Blueprint $table) {
                $table->dropColumn('updated_at');
            }
        );
    }
}
