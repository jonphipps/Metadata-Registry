<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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
			$table->integer('id', true);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->index('reg_schema_property_element_history_idx1');
			$table->integer('created_user_id')->nullable()->index('created_user_id');
			$table->enum('action', array('updated','added','deleted','force_deleted','generated'))->nullable();
			$table->integer('schema_property_element_id')->nullable()->index('schema_property_element_id');
			$table->integer('schema_property_id')->nullable()->index('schema_property_id');
			$table->integer('schema_id')->nullable()->index('schema_id');
			$table->integer('profile_property_id')->nullable()->index('profile_property_id');
			$table->text('object')->nullable();
			$table->integer('related_schema_property_id')->nullable()->index('related_schema_property_id');
			$table->char('language', 6);
			$table->integer('status_id')->nullable()->default(1)->index('status_id');
			$table->text('change_note')->nullable();
			$table->integer('import_id')->nullable()->index('reg_schema_property_element_history_fk7');
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
