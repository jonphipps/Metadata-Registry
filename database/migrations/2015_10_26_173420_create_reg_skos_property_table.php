<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegSkosPropertyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_skos_property',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('parent_id')->nullable();
                $table->integer('inverse_id')->nullable();
                $table->string('name', 190)->default('')->unique('name_2');
                $table->string('uri', 190)->default('')->unique('uri_2');
                $table->enum('object_type', [ 'resource', 'literal' ])->default('resource');
                $table->integer('display_order')->nullable();
                $table->integer('picklist_order')->nullable();
                $table->string('label')->nullable();
                $table->text('definition')->nullable();
                $table->text('comment')->nullable();
                $table->string('examples')->nullable();
                $table->boolean('is_required')->default(0);
                $table->boolean('is_reciprocal')->default(0);
                $table->boolean('is_singleton')->default(0);
                $table->boolean('is_scheme')->default(0);
                $table->boolean('is_in_picklist')->default(1);
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_skos_property');
    }

}
