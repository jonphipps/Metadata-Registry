<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegConceptPropertyHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_concept_property_history', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->enum('action', array('updated','added','deleted','force_deleted'))->nullable();
			$table->integer('concept_property_id')->unsigned()->nullable()->index();
			$table->integer('concept_id')->unsigned()->nullable()->index();
			$table->integer('vocabulary_id')->unsigned()->nullable()->index();
			$table->integer('skos_property_id')->unsigned()->nullable()->index();
			$table->mediumText('object')->nullable();
			$table->integer('scheme_id')->unsigned()->nullable()->index();
			$table->integer('related_concept_id')->unsigned()->nullable()->index();
			$table->char('language', 6)->nullable()->default('en')->comment('This will be an RFC3066 language code, which means it can be en, eng, en-us, or eng-us -- iso639-1 (2-char codes), iso639-2 (3-char codes), and combined with iso3166 (2-char country codes)');
			$table->integer('status_id')->unsigned()->nullable()->default(1)->index();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->text('change_note')->nullable();
			$table->integer('import_id')->unsigned()->nullable()->index();
			$table->integer('profile_property_id')->unsigned()->nullable()->index();
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
		Schema::drop('reg_concept_property_history');
	}

}
