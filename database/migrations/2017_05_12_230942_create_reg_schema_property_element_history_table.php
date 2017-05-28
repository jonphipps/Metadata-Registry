<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegSchemaPropertyElementHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_schema_property_element_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->enum('action', array('updated','added','deleted','force_deleted','generated'))->nullable();
			$table->integer('schema_property_element_id')->unsigned()->nullable()->index('reg_schema_propel_hist_schema_propel_id_index');
			$table->integer('schema_property_id')->unsigned()->nullable()->index();
			$table->integer('schema_id')->unsigned()->nullable()->index();
			$table->integer('profile_property_id')->unsigned()->nullable()->index();
			$table->mediumText('object')->nullable();
			$table->integer('related_schema_property_id')->unsigned()->nullable()->index('reg_schema_propel_hist_rel_schema_propel_id_index');
			$table->char('language', 6);
			$table->integer('status_id')->unsigned()->nullable()->default(1)->index();
			$table->text('change_note')->nullable();
			$table->integer('import_id')->unsigned()->nullable()->index();
			$table->integer('created_by')->unsigned()->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_schema_property_element_history');
	}

}
