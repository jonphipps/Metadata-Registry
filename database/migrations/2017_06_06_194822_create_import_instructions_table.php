<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class CreateImportInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //@formatter:off
        Schema::create('import_instructions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('import_id')->index();
            $table->foreign('import_id')->references('id')->on('reg_file_import_history')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->enum('action', [ 'updated', 'added', 'deleted', 'force_deleted', 'generated' ])->nullable();
            $table->unsignedInteger('profile_property_id')->nullable()->index();
            $table->foreign('profile_property_id')->references('id')->on('profile_property')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->string('profile_property_label');
            $table->mediumText('before_value')->nullable();
            $table->mediumText('after_value')->nullable();
            $table->char('language', 12)->default('en');

            //statement IDs
            $table->unsignedInteger('concept_property_id')->nullable()->index();
            $table->unsignedInteger('schema_property_element_id')->nullable()->index('reg_schema_propel_hist_schema_propel_id_index');

            //resource_IDs
            //$table->unsignedInteger('concept_id')->nullable()->index();
            //$table->unsignedInteger('schema_property_id')->nullable()->index();

            //generic ID and label
            $table->unsignedInteger('resource_id')->nullable();
            $table->mediumText('resource_label')->nullable();

            //vocabulary|elementSet IDs
            //$table->unsignedInteger('vocabulary_id')->nullable()->index();
            //$table->unsignedInteger('schema_id')->nullable()->index();
        });
        //@formatter:on
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_instructions',
            function(Blueprint $table) {
                $table->dropForeign('import_instructions_import_id_foreign');
                $table->dropForeign('import_instructions_profile_property_id_foreign');
            });
        Schema::dropIfExists('import_instructions');
    }
}
