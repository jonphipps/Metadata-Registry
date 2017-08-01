<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegSchemaPropertyElementHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_schema_property_element_history',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->enum('action', [ 'updated', 'added', 'deleted', 'force_deleted', 'generated' ])->nullable();
                $table->unsignedInteger('schema_property_element_id')->nullable()->index('reg_schema_propel_hist_schema_propel_id_index');
                $table->unsignedInteger('schema_property_id')->nullable()->index();
                $table->unsignedInteger('schema_id')->nullable()->index();
                $table->unsignedInteger('profile_property_id')->nullable()->index();
                $table->mediumText('object')->nullable();
                $table->unsignedInteger('related_schema_property_id')->nullable()->index('reg_schema_propel_hist_rel_schema_propel_id_index');
                $table->char('language', 12)->nullable()->default('en');
                $table->unsignedInteger('status_id')->nullable()->default(1)->index();
                $table->text('change_note')->nullable();
                $table->unsignedInteger('import_id')->nullable()->index();
                $table->unsignedInteger('created_by')->nullable()->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_schema_property_element_history');
    }
}
