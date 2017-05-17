<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegDiscussTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_discuss', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('deleted_user_id')->unsigned()->nullable()->index();
			$table->char('uri')->nullable()->index();
			$table->integer('schema_id')->unsigned()->nullable()->index();
			$table->integer('schema_property_id')->unsigned()->nullable()->index();
			$table->integer('schema_property_element_id')->unsigned()->nullable()->index();
			$table->integer('vocabulary_id')->unsigned()->nullable()->index();
			$table->integer('concept_id')->unsigned()->nullable()->index();
			$table->integer('concept_property_id')->unsigned()->nullable()->index();
			$table->integer('root_id')->unsigned()->nullable()->index();
			$table->integer('parent_id')->unsigned()->nullable()->index();
			$table->string('subject')->nullable();
			$table->text('content')->nullable();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
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
