<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('releases',
            function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('user_id')->nullable()->index();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');
                $table->unsignedInteger('agent_id')->nullable()->index();
                $table->foreign('agent_id')
                    ->references('id')
                    ->on('reg_agent')
                    ->onUpdate('NO ACTION')
                    ->onDelete('CASCADE');
                $table->string('name');
                $table->mediumText('body')->nullable();
                $table->string('tag_name');
                $table->string('target_commitish')->default('master');
                $table->boolean('is_draft')->nullable();
                $table->boolean('is_prerelease')->nullable();
                $table->json('github_response')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releases');
    }
}
