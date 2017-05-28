<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateProfilePropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile_property', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('skos_id')->unsigned()->default(0)->index();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
			$table->integer('profile_id')->unsigned()->index();
			$table->integer('skos_parent_id')->unsigned()->nullable();
			$table->string('name')->default('');
			$table->string('label')->default('');
			$table->text('definition')->nullable();
			$table->text('comment')->nullable();
			$table->enum('type', array('property','subproperty','class','subclass'))->default('property');
			$table->string('uri')->nullable();
			$table->integer('status_id')->unsigned()->default(1)->index();
			$table->string('language', 6)->default('en');
			$table->text('note')->nullable();
			$table->integer('display_order')->nullable()->comment('Display order of properties');
			$table->integer('export_order')->nullable()->comment('Display order of properties');
			$table->integer('picklist_order')->nullable();
			$table->string('examples')->nullable()->comment('Link to example usage');
			$table->boolean('is_required')->default(0)->comment('boolean -- id this value required');
			$table->boolean('is_reciprocal')->default(0)->comment('boolean - subject and object must both have this property');
			$table->boolean('is_singleton')->default(0)->comment('boolean -- is this property allowed to repeat for a concept');
			$table->boolean('is_in_picklist')->default(1)->comment('boolean - is in the property picklist');
			$table->boolean('is_in_export')->default(1);
			$table->integer('inverse_profile_property_id')->unsigned()->nullable()->index();
			$table->boolean('is_in_class_picklist')->default(1)->comment('boolean - is in the property picklist');
			$table->boolean('is_in_property_picklist')->default(1)->comment('boolean - is in the property picklist');
			$table->boolean('is_in_rdf')->default(1)->comment('boolean - should this display in the RDF');
			$table->boolean('is_in_xsd')->default(1)->comment('boolean - should this display in the XSD');
			$table->boolean('is_attribute')->default(0)->comment('boolean - is this an attribute? attributes are not editable outside the main form');
			$table->boolean('has_language')->default(0)->comment('Boolean that determines whether language attribute is displayed for this property');
			$table->boolean('is_object_prop')->default(1);
			$table->boolean('is_in_form')->default(0);
			$table->string('namespce')->default('');
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
