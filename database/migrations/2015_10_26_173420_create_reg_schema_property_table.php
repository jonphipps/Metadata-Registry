<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegSchemaPropertyTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'reg_schema_property',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->integer('created_user_id')->nullable()->index();
                $table->integer('updated_user_id')->nullable()->index();
                $table->integer('schema_id')->index();
                $table->string('name')->default('');
                $table->string('label')->default('');
                $table->text('definition')->nullable();
                $table->text('comment')->nullable();
                $table->string('type', 15)->default('property');
                $table->integer('is_subproperty_of')->nullable()->index('subproperty_id');
                $table->string('parent_uri')->nullable();
                $table->string('uri')->default('')->index('reg_schema_property_idx1');
                $table->integer('status_id')->default(1)->index();
                $table->string('language', 6)->default('');
                $table->text('note')->nullable();
                $table->string('domain')->nullable();
                $table->string('orange')->nullable();
                $table->boolean('is_deprecated')->nullable();
                $table->string('url')->nullable();
                $table->string('lexical_alias')->nullable();
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
        Schema::drop('reg_schema_property');
    }
}
