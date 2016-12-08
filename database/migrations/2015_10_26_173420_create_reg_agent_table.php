<?php

use Illuminate\Database\Migrations\Migration;
 use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateRegAgentTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_agent',
            function (Blueprint $table) {
                $table->integer('id', true);
                $table->dateTime('created_at')->nullable();
                $table->timestamp('last_updated')->default(DB::raw('CURRENT_TIMESTAMP'))->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
                $table->dateTime('deleted_at')->nullable();
                $table->string('org_email', 100)->default('');
                $table->string('org_name')->default('');
                $table->string('ind_affiliation')->nullable();
                $table->string('ind_role', 45)->nullable();
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('city', 45)->nullable();
                $table->char('state', 2)->nullable();
                $table->string('postal_code', 15)->nullable();
                $table->char('country', 3)->nullable();
                $table->string('phone', 45)->nullable();
                $table->string('web_address')->nullable();
                $table->char('type', 15)->nullable();
            });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reg_agent');
    }

}
