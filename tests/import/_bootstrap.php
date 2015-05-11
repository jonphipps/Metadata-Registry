<?php
// Here you can initialize variables that will be available to your tests
use ImportVocab\ImportVocab;

//$this->tester->resetDatabase2('swregistry_test_update.sql');
$import = new ImportVocab("schema", "updatedata.csv", 81);
$import->importFolder = "/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/";
