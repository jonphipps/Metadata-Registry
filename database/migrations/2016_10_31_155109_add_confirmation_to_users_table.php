<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_user',
            function(Blueprint $table) {
                $table->string('confirmation_code')->default('');
                $table->string('name', 191)->default('');
                $table->boolean('confirmed')->default(config('access.users.confirm_email')? false: true);
                $table->rememberToken();
            });
        //set a random unique confirmation code
        $code = DB::getDriverName() == 'mysql'? "md5(SYSDATE(6))": "hex(randomblob(16))";
        DB::statement("update reg_user set confirmation_code = $code;");
        DB::statement('UPDATE reg_user SET name = nickname;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_user',
            function(Blueprint $table) {
                $table->dropColumn([ 'confirmation_code', 'confirmed', 'name', 'status' ]);
            });
    }
}
