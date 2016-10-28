<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegSchemaPropertyElementTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_schema_property_element',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')
                      ->default(DB::raw('CURRENT_TIMESTAMP'))
                      ->index('reg_schema_property_element_idx2');
                $table->dateTime('deleted_at')->nullable();
                $table->integer('created_user_id')->nullable()->index('created_user_id');
                $table->integer('updated_user_id')->nullable()->index('updated_user_id');
                $table->integer('schema_property_id')->index('schema_property_id');
                $table->integer('profile_property_id')->index('profile_property_id');
                $table->boolean('is_schema_property')->nullable();
                $table->text('object')->default('');
                $table->integer('related_schema_property_id')->nullable()->index('related_property_id');
                $table->char('language', 6);
                $table->integer('status_id')->nullable()->default(1)->index('status_id');
                $table->boolean('is_generated')->default(0);
            });
        DB::statement('CREATE INDEX reg_schema_property_element_idx1 ON reg_schema_property_element (object(150));');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_schema_property_element');
    }

}
