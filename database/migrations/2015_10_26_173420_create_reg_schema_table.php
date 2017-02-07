<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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
                $table->integer('id', true);
                $table->integer('agent_id')->index('agent_id');
                $table->dateTime('created_at')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->integer('created_user_id')->nullable()->index();
                $table->integer('updated_user_id')->nullable()->index();
                $table->dateTime('child_updated_at')->nullable();
                $table->integer('child_updated_user_id')->nullable()->index('child_updated_user_id');
                $table->string('name', 191)->default('')->index('reg_schema_idx2');
                $table->text('note')->nullable();
                $table->string('uri')->default('', 191)->index('reg_schema_idx1');
                $table->string('url')->nullable();
                $table->string('base_domain')->default('');
                $table->string('token', 45)->default('');
                $table->string('community', 45)->nullable();
                $table->integer('last_uri_id')->nullable()->default(100000);
                $table->integer('status_id')->default(1)->index();
                $table->char('language', 6)->default('en');
                $table->integer('profile_id')->nullable()->index();
                $table->char('ns_type', 6)->default('slash');
                $table->text('prefixes', 65535)->nullable();
                $table->text('languages', 65535)->nullable();
                $table->string('repo')->nullable();
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
