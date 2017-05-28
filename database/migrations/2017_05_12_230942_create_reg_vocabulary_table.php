<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegVocabularyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_vocabulary',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('agent_id')->nullable()->index();
                $table->unsignedInteger('created_user_id')->nullable()->index();
                $table->unsignedInteger('updated_user_id')->nullable()->index();
                $table->unsignedInteger('deleted_user_id')->nullable()->index();
                $table->dateTime('child_updated_at')->nullable();
                $table->unsignedInteger('child_updated_user_id')->nullable()->index();
                $table->string('name')->default('')->index();
                $table->text('note')->nullable();
                $table->string('uri')->default('')->index();
                $table->string('url')->nullable();
                $table->string('base_domain')->default('');
                $table->string('token', 45)->default('');
                $table->string('community', 45)->nullable();
                $table->unsignedInteger('last_uri_id')->nullable()->default(1000);
                $table->unsignedInteger('status_id')->default(1)->index();
                $table->char('language', 12)->default('en')->comment('This is the default language for all concept properties');
                $table->text('languages')->nullable();
                $table->unsignedInteger('profile_id')->nullable()->index();
                $table->enum('ns_type', [ 'hash', 'slash' ])->default('slash');
                $table->text('prefixes')->nullable();
                $table->string('repo')->nullable();
                $table->string('prefix')->default('');
                $table->unsignedInteger('created_by')->nullable()->index();
                $table->unsignedInteger('updated_by')->nullable()->index();
                $table->unsignedInteger('deleted_by')->nullable()->index();
                $table->unsignedInteger('child_updated_by')->nullable()->index();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_vocabulary');
    }
}
