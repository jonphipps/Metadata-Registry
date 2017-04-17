<?php
use App\Models\Prefix;
use App\Models\ProfileProperty;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProfilePropertiesAddNamespace extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('profile_property',
        function (Blueprint $table) {
          $table->string('namespce', 255)->default('');
        });
    $properties = ProfileProperty::all();
    $prefix     = Prefix::wherePrefix('reg')->first();
    if ( ! $prefix) {
      Prefix::create(array_combine([ 'prefix', 'uri', 'rank' ],
                                   [
                                       'reg', 'http://metadataregistry.org/uri/profile/regap/', 1500,
                                   ]));
    }
    $prefix = Prefix::wherePrefix('rdakit')->first();
    if ( ! $prefix) {
      Prefix::create(array_combine([ 'prefix', 'uri', 'rank' ],
                                   [
                                       'rdakit', 'http://metadataregistry.org/uri/profile/rdakit/',
                                       1501,
                                   ]));
    }
    foreach ($properties as $property) {
      $uri = explode(':', $property->uri);
      $prefix = Prefix::wherePrefix($uri[0])->first();
      if ( ! $prefix) {
        echo "**************\nMissing prefix: $uri[0]\n";
        continue;
      }
      $property->namespce = $prefix->uri;
      $property->save();
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('profile_property',
        function (Blueprint $table) {
          $table->dropColumn('namespce');
        });
  }
}
