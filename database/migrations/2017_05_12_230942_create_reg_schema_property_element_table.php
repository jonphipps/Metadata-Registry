<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegSchemaPropertyElementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_schema_property_element',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('updated_user_id')->nullable()->index();
                $table->unsignedInteger('deleted_user_id')->nullable()->index();
                $table->unsignedInteger('schema_property_id')->index();
                $table->unsignedInteger('profile_property_id')->index();
                $table->boolean('is_schema_property')->nullable();
                $table->mediumText('object');
                $table->unsignedInteger('related_schema_property_id')->nullable()->index();
                $table->char('language', 12)->nullable()->default('en');
                $table->unsignedInteger('status_id')->nullable()->default(1)->index();
                $table->unsignedInteger('last_import_id')->nullable()->index();
                $table->boolean('is_generated')->default(0);
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
            });
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE reg_schema_property_element ADD FULLTEXT full( `object`)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_schema_property_element');
    }
}
