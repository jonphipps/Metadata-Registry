<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateProfileTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('agent_id')->index('profile_agent_id');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->nullable()->index('profile_created_by');
            $table->integer('updated_by')->nullable()->index('profile_updated_by');
            $table->integer('deleted_by')->nullable()->index('profile_deleted_by');
            $table->dateTime('child_updated_at')->nullable();
            $table->integer('child_updated_by')->nullable()->index('profile_child_updated_by');
            $table->string('name')->default('');
            $table->text('note')->nullable();
            $table->string('uri')->default('');
            $table->string('url')->nullable();
            $table->string('base_domain')->default('');
            $table->string('token', 45)->default('');
            $table->string('community', 45)->nullable();
            $table->integer('last_uri_id')->nullable()->default(100000);
            $table->integer('status_id')->default(1)->index('profile_status_id');
            $table->char('language', 6)->default('en');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile');
    }
}
