<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnlyacceptedFieldToExport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_export_history', function (Blueprint $table) {
            $table->boolean('include_not_accepted')->after('include_deleted')->nullable();
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_export_history', function (Blueprint $table) {
            $table->dropColumn('include_not_accepted');
        });
    }
}
