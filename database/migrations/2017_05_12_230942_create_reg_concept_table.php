<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateRegConceptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_concept', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('updated_user_id')->unsigned()->nullable()->index();
			$table->string('uri')->default('')->index();
			$table->text('lexical_alias')->nullable();
			$table->string('pref_label')->nullable()->default('')->index();
			$table->integer('vocabulary_id')->unsigned()->nullable()->index();
			$table->boolean('is_top_concept')->nullable();
			$table->integer('pref_label_id')->unsigned()->nullable()->index();
			$table->integer('status_id')->unsigned()->default(1)->index();
			$table->char('language', 10)->default('en');
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
			$table->unique(['vocabulary_id','pref_label','language'], 'vocabulary_id_pref_label');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_concept');
	}

}
