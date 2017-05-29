<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableIxudraWizardFlows extends Migration {

    public function up()
    {
        Schema::create('flows', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->text('config');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flows');
    }

}
