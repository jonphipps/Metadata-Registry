<?php

use App\Models\Release;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignReleasesKeyToReleaseablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('releaseables', function (Blueprint $table) {
            $table->foreign('release_id')->references('id')->on(Release::TABLE)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('releaseables', function (Blueprint $table) {
            $table->dropForeign('releaseables_release_id_foreign');
        });
    }
}
