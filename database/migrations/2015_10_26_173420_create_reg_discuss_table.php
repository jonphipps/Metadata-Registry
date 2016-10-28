<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegDiscussTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_discuss',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->integer('created_user_id')->nullable()->index('created_user_id');
                $table->integer('deleted_user_id')->nullable()->index('deleted_user_id');
                $table->char('uri')->nullable()->index('uri');
                $table->integer('schema_id')->nullable()->index('schema_id');
                $table->integer('schema_property_id')->nullable()->index('schema_property_id');
                $table->integer('schema_property_element_id')->nullable()->index('schema_property_element_id');
                $table->integer('vocabulary_id')->nullable()->index('vocabulary_id');
                $table->integer('concept_id')->nullable()->index('concept_id');
                $table->integer('concept_property_id')->nullable()->index('concept_property_id');
                $table->integer('root_id')->nullable()->index('root_id');
                $table->integer('parent_id')->nullable()->index('parent_id');
                $table->string('subject')->nullable();
                $table->text('content')->nullable();
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_discuss');
    }

}
