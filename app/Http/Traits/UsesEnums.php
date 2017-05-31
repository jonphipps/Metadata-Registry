<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-30,  Time: 12:20 PM */

namespace App\Http\Traits;

use Illuminate\Support\Facades\Schema;

trait UsesEnums
{
    // this is the fix suggested from the Github Issue (https://goo.gl/wN7dEd) Thank you @zschuessler
    public function addCustomDoctrineColumnTypes()
    {
        $dbPlatform = Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $dbPlatform->registerDoctrineTypeMapping('enum', 'string');
        $dbPlatform->registerDoctrineTypeMapping('json', 'json_array');
    }
}
