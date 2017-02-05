<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegVocabularyHasUserTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reg_vocabulary_has_user',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->integer('vocabulary_id')->default(0);
                $table->integer('user_id')->default(0);
                $table->boolean('is_maintainer_for')->nullable()->default(1);
                $table->boolean('is_registrar_for')->nullable()->default(1);
                $table->boolean('is_admin_for')->nullable()->default(1);
                $table->text('languages', 65535)->nullable();
                $table->char('default_language', 6)->nullable()->default('en');
                $table->char('current_language', 6)->nullable()->default('en');
                $table->unique([ 'vocabulary_id', 'user_id' ], 'resource_user_id');
                $table->unique([ 'user_id', 'vocabulary_id' ], 'user_resource_id');
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
        Schema::drop('reg_vocabulary_has_user');
    }
}
