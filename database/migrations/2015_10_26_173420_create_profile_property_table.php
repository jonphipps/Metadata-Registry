<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_property',
            function(Blueprint $table) {
                $table->integer('id', true);
                $table->integer('skos_id')->default(0)->index('profile_property_skos_id');
                $table->dateTime('created_at')->nullable();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->integer('created_by')->nullable()->index('profile_property_created_by');
                $table->integer('updated_by')->nullable()->index('profile_property_updated_by');
                $table->integer('deleted_by')->nullable()->index('profile_property_deleted_by');
                $table->integer('profile_id')->index('profile_id');
                $table->integer('skos_parent_id')->nullable();
                $table->string('name')->default('');
                $table->string('label')->default('');
                $table->text('definition')->nullable();
                $table->text('comment')->nullable();
                $table->enum('type', [ 'property', 'subproperty', 'class', 'subclass' ])->default('property');
                $table->string('uri')->nullable();
                $table->integer('status_id')->default(1)->index('profile_property_status_id');
                $table->string('language', 6)->default('en');
                $table->text('note')->nullable();
                $table->integer('display_order')->nullable();
                $table->integer('export_order')->nullable();
                $table->integer('picklist_order')->nullable();
                $table->string('examples')->nullable();
                $table->boolean('is_required')->default(0);
                $table->boolean('is_reciprocal')->default(0);
                $table->boolean('is_singleton')->default(0);
                $table->boolean('is_in_picklist')->default(1);
                $table->boolean('is_in_export')->default(1);
                $table->integer('inverse_profile_property_id')->nullable()->index('inverse_profile_property_id');
                $table->boolean('is_in_class_picklist')->default(1);
                $table->boolean('is_in_property_picklist')->default(1);
                $table->boolean('is_in_rdf')->default(1);
                $table->boolean('is_in_xsd')->default(1);
                $table->boolean('is_attribute')->default(0);
                $table->boolean('has_language')->default(0);
                $table->boolean('is_object_prop')->default(1);
                $table->boolean('is_in_form')->default(0);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile_property');
    }
}
