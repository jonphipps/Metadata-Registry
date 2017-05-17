<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegConceptPropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_concept_property', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->dateTime('last_updated')->nullable();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('updated_user_id')->unsigned()->nullable()->index();
			$table->integer('concept_id')->unsigned()->index();
			$table->boolean('primary_pref_label')->nullable();
			$table->integer('skos_property_id')->unsigned()->nullable()->index();
			$table->text('object')->nullable();
			$table->integer('scheme_id')->unsigned()->nullable()->index();
			$table->integer('related_concept_id')->unsigned()->nullable()->index();
			$table->char('language', 6)->nullable()->default('en');
			$table->integer('status_id')->unsigned()->nullable()->default(1)->index();
			$table->boolean('is_concept_property')->default(0);
			$table->integer('profile_property_id')->unsigned()->nullable()->index();
			$table->boolean('is_generated')->default(0);
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
		});
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE reg_concept_property ADD FULLTEXT full( `object`)');
        }
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_concept_property');
	}

}
