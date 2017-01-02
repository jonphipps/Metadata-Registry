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
                $table->integer('created_user_id')->nullable()->index();
                $table->integer('updated_user_id')->nullable()->index();
                $table->integer('schema_property_id')->index();
                $table->integer('profile_property_id')->index();
                $table->boolean('is_schema_property')->nullable();
                $table->text('object')->default('');
                $table->integer('related_schema_property_id')->nullable()->index();
                $table->char('language', 6);
                $table->integer('status_id')->nullable()->default(1)->index();
                $table->boolean('is_generated')->default(0);
            });
      if (DB::getDriverName() == 'mysql') {
        DB::statement('CREATE INDEX reg_schema_property_element_idx1 ON reg_schema_property_element (object(150));');
      } else {
        DB::statement('CREATE INDEX reg_schema_property_element_idx1 ON reg_schema_property_element (object);');
      }
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
