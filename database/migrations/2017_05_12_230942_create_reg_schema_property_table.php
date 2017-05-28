<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegSchemaPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_schema_property',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('updated_user_id')->nullable()->index();
                $table->unsignedInteger('deleted_user_id')->nullable()->index();
                $table->unsignedInteger('schema_id')->index();
                $table->text('name')->nullable();
                $table->text('label')->nullable();
                $table->text('definition')->nullable();
                $table->text('comment')->nullable();
                $table->string('type', 15)->default('property');
                $table->unsignedInteger('is_subproperty_of')->nullable()->index();
                $table->string('parent_uri')->nullable();
                $table->string('uri')->default('')->index();
                $table->unsignedInteger('status_id')->default(1)->index();
                $table->char('language', 12)->default('en');
                $table->text('note')->nullable();
                $table->string('domain')->nullable();
                $table->string('orange')->nullable();
                $table->boolean('is_deprecated')->nullable()->comment('Boolean. Has this class/property been deprecated');
                $table->string('url')->nullable();
                $table->text('lexical_alias')->nullable();
                $table->char('hash_id')->default('')->index();
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
            });
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE reg_schema_property ADD FULLTEXT full( `label`)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_schema_property');
    }
}
