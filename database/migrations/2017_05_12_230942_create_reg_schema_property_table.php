<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegSchemaPropertyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_schema_property', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('updated_user_id')->unsigned()->nullable()->index();
			$table->integer('deleted_user_id')->unsigned()->nullable()->index();
			$table->integer('schema_id')->unsigned()->index();
			$table->text('name')->nullable();
			$table->text('label')->nullable();
			$table->text('definition')->nullable();
			$table->text('comment')->nullable();
			$table->string('type', 15)->default('property');
			$table->integer('is_subproperty_of')->unsigned()->nullable()->index();
			$table->string('parent_uri')->nullable();
			$table->string('uri')->default('')->index();
			$table->integer('status_id')->unsigned()->default(1)->index();
			$table->char('language', 10)->default('');
			$table->text('note')->nullable();
			$table->string('domain')->nullable();
			$table->string('orange')->nullable();
			$table->boolean('is_deprecated')->nullable()->comment('Boolean. Has this class/property been deprecated');
			$table->string('url')->nullable();
			$table->text('lexical_alias')->nullable();
			$table->char('hash_id')->default('')->index();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
		});
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE reg_schema_property ADD FULLTEXT full( `label`)');
        }
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
