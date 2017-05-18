<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-17,  Time: 6:20 PM */

namespace App\CRUD;

use Backpack\CRUD\CrudPanel;
use Backpack\CRUD\PanelTraits\AutoSet;
use Illuminate\Support\Facades\Schema;

class CustomCrudPanel extends CrudPanel
{
    use AutoSet {
        // we're overriding the original method from the AutoSet trait
        setFromDb as parentSetFromDb;
    }

    public function setFromDb()
    {
        // register custom column types
        $this->addCustomDoctrineColumnTypes();

        // call the parent method so that all attributes are initialized properly
        $this->parentSetFromDb();
    }

    // this is the fix suggested from the Github Issue (https://goo.gl/wN7dEd) Thank you @zschuessler
    public function addCustomDoctrineColumnTypes()
    {
        $dbPlatform = Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $dbPlatform->registerDoctrineTypeMapping('enum', 'string');
        $dbPlatform->registerDoctrineTypeMapping('json', 'json_array');
    }
}
