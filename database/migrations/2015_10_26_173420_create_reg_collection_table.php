<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_collection',
            function(Blueprint $table) {
                $table->integer('id', true);
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();;
                $table->timestamp('deleted_at')->nullable();
                $table->timestamp('last_updated')->nullable();
                $table->integer('created_user_id')->nullable()->index('created_user_id');
                $table->integer('updated_user_id')->nullable()->index('updated_user_id');
                $table->integer('vocabulary_id')->nullable()->index('vocabulary_id');
                $table->string('name')->default('');
                $table->string('uri')->nullable();
                $table->string('pref_label')->default('');
                $table->integer('status_id')->default(1)->index('status_id');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_collection');
    }
}
