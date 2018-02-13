<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegSchemaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reg_schema',
            function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('updated_user_id')->nullable()->index();
                $table->unsignedInteger('deleted_user_id')->nullable()->index();
                $table->dateTime('child_updated_at')->nullable();
                $table->unsignedInteger('child_updated_user_id')->nullable()->index();
                $table->unsignedInteger('agent_id')->nullable()->index();
                $table->text('label')->nullable();
                $table->text('name')->nullable();
                $table->text('note')->nullable();
                $table->string('uri')->default('')->index();
                $table->string('url')->nullable();
                $table->string('base_domain')->default('');
                $table->string('token', 45)->default('');
                $table->string('community', 45)->nullable();
                $table->unsignedInteger('last_uri_id')->nullable()->default(100000);
                $table->unsignedInteger('status_id')->default(1)->index();
                $table->char('language', 12)->default('en');
                $table->unsignedInteger('profile_id')->nullable()->index();
                $table->char('ns_type', 6)->default('slash');
                $table->text('prefixes')->nullable();
                $table->text('languages')->nullable();
                $table->string('repo')->nullable();
                $table->string('spreadsheet')->nullable();
                $table->string('worksheet')->nullable();
                $table->string('prefix')->default('');
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
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
        Schema::drop('reg_schema');
    }
}
