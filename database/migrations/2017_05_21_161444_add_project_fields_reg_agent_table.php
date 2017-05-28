<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** @noinspection AutoloadingIssuesInspection */
class AddProjectFieldsRegAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_agent',
            function(Blueprint $table) {
                $table->string('name')->nullable();
                $table->string('label')->nullable();
                $table->string('url')->nullable();
                $table->string('license_uri')->nullable();
                $table->string('base_domain')->nullable();
                $table->enum('namespace_type', [ 'Hash', 'Slash' ])->nullable();
                $table->enum('uri_strategy',
                    [
                        'Numeric',
                        'snake_case',
                        'SCREAMING_SNAKE_CASE',
                        'hyphen-case',
                        'dot.case',
                        'camelCase',
                        'PascalCase',
                    ])->nullable();
                $table->string('uri_prepend')->nullable();
                $table->string('uri_append')->nullable();
                $table->unsignedInteger('starting_number')->nullable();
                $table->string('default_language')->nullable();
                $table->text('languages')->nullable();
                $table->text('prefixes')->nullable();
                $table->string('google_sheet_url')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
