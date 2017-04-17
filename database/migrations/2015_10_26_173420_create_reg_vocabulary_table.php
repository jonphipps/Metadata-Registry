<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegVocabularyTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('reg_vocabulary',
        function (Blueprint $table) {
          $table->integer('id', true);
          $table->integer('agent_id')->index();
          $table->dateTime('created_at')->nullable();
          $table->dateTime('deleted_at')->nullable();
          $table->timestamp('last_updated')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->integer('created_user_id')->nullable()->index();
          $table->integer('updated_user_id')->nullable()->index();
          $table->dateTime('child_updated_at')->nullable();
          $table->integer('child_updated_user_id')->nullable()->index();
          $table->string('name')->default('')->index('reg_vocabulary_idx2');
          $table->text('note')->nullable();
          $table->string('uri')->default('')->index('reg_vocabulary_idx1');
          $table->string('url')->nullable();
          $table->string('base_domain')->default('');
          $table->string('token', 45)->default('');
          $table->string('community', 45)->nullable();
          $table->integer('last_uri_id')->nullable()->default(1000);
          $table->integer('status_id')->default(1)->index();
          $table->char('language', 6)->default('en');
          $table->text('languages')->nullable();
          $table->integer('profile_id')->nullable()->index();
          $table->enum('ns_type', [ 'hash', 'slash' ])->default('slash');
          $table->text('prefixes')->nullable();
          $table->string('repo', 256)->nullable();
        });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('reg_vocabulary');
  }
}
