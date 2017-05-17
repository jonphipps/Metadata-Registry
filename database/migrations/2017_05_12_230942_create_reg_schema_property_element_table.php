<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegSchemaPropertyElementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reg_schema_property_element', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('created_user_id')->unsigned()->nullable()->index();
			$table->integer('updated_user_id')->unsigned()->nullable()->index();
			$table->integer('deleted_user_id')->unsigned()->nullable()->index();
			$table->integer('schema_property_id')->unsigned()->index();
			$table->integer('profile_property_id')->unsigned()->index();
			$table->boolean('is_schema_property')->nullable();
			$table->mediumText('object');
			$table->integer('related_schema_property_id')->unsigned()->nullable()->index();
			$table->char('language', 6);
			$table->integer('status_id')->unsigned()->nullable()->default(1)->index();
			$table->boolean('is_generated')->default(0);
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->integer('deleted_by')->unsigned()->nullable()->index();
		});
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE reg_schema_property_element ADD FULLTEXT full( `object`)');
        }
    }


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reg_schema_property_element');
	}

}
