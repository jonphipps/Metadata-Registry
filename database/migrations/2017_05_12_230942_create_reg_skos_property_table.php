<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegSkosPropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_skos_property', function(Blueprint $table)
		{
			$table->increments('id');
            $table->timestamps();
			$table->integer('parent_id')->unsigned()->nullable();
			$table->integer('inverse_id')->unsigned()->nullable()->comment('id of the inverse property');
			$table->string('name')->default('')->unique('name_2');
			$table->string('uri')->default('')->unique('uri_2');
			$table->enum('object_type', array('resource','literal'))->default('resource')->comment('the type of the object for which this is the predicate');
			$table->integer('display_order')->nullable()->comment('Display order of properties');
			$table->integer('picklist_order')->nullable();
			$table->string('label')->nullable()->comment('The pretty label for the property');
			$table->text('definition')->nullable();
			$table->text('comment')->nullable();
			$table->string('examples')->nullable()->comment('Link to example usage');
			$table->boolean('is_required')->default(0)->comment('boolean -- id this value required');
			$table->boolean('is_reciprocal')->default(0)->comment('boolean - subject and object must both have this property');
			$table->boolean('is_singleton')->default(0)->comment('boolean -- is this property allowed to repeat for a concept');
			$table->boolean('is_scheme')->default(0)->comment('boolean - is in conceptScheme domain');
			$table->boolean('is_in_picklist')->default(1)->comment('boolean - is in the property picklist');
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
