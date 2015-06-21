<?php
use \ImportTester;
use ImportVocab\ImportVocab;

class importUpdatePrologCest
{
    /**
     * @var ImportVocab
     */
    protected $import;

    public function _before(ImportTester $I)
    {
        //$I->resetDatabase2('swregistry_test_update.sql');
        $this->import = new ImportVocab("schema", "updatedata.csv", 81);
        $this->import->importFolder = "/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/";

    }

    public function _after(ImportTester $I)
    {
    }

    // tests
    public function tryToTestSetup(ImportTester $I)
    {

        //echo var_dump(get_class($this->import));
        verify(
              "ImportVocab is a class = " . get_class($this->import),
              get_class($this->import) == 'ImportVocab\ImportVocab'
        )->true();
        $I->canSeeInDatabase('reg_schema_property', ['schema_id' => 81, "name" => 'respondentOf']);
        $I->canSeeInDatabase('reg_schema_property_element', ['id' => 121276, "object" => 'respondentOf']);
        $I->canSeeInDatabase('reg_schema_property_element_history', ['id' => 139292, "object" => 'respondentOf']);

    }

    public function testClassIsInitializedProperly()
    {
        verify("the type is set to 'schema'", $this->import->type)->equals("schema");
        verify("the vocabid is set to '81'", $this->import->vocabId)->equals(81);
        verify("the file is set to 'updatedata.csv'", $this->import->file)->equals("updatedata.csv");
        verify("the type is set to 'schema'", $this->import->type)->equals("schema");
        verify_that(is_integer($this->import->vocabId));
        verify("the path is set", $this->import->importFolder . $this->import->file)->equals("/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/updatedata.csv");
    }

    public function testOpeningTheFile()
    {
        $reader = $this->import->setCsvReader($this->import->file);
        verify(
              "Reading the file doesn't return an error",
              get_class($reader)
        )->equals("Ddeboer\\DataImport\\Reader\\CsvReader");
    }
}
