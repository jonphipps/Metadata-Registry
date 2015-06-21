<?php
use Codeception\Util\Stub;
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;

class importUpdateTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var ImportVocab
     */
    protected $import;

    protected function _before()
    {
        //$this->tester->resetDatabase2('swregistry_test_update.sql');
        $this->import = new ImportVocab("schema", "updatedata.csv", 81);
        $this->import->importFolder = Fixtures::get("importFolder");
    }

    protected function _after()
    {
    }

    // tests
    public function testCodecepSetupProperly()
    {
        //echo var_dump(get_class($this->import));
        verify(
          "ImportVocab is a class = " . get_class($this->import),
          get_class($this->import) == 'ImportVocab\ImportVocab'
        )->true();
        $this->tester->canSeeInDatabase('reg_schema_property', ['schema_id' => 81, "name" => 'respondentOf']);
        //$this->tester->canSeeInDatabase('reg_schema_property_element', ['id' => 1, "object" => 'subjectTo']);
        //$this->tester->canSeeInDatabase('reg_schema_property_element_history', ['id' => 1, "object" => 'subjectTo']);
    }

    public function testClassIsInitializedProperly()
    {
        $this->assertEquals("schema", $this->import->type, "the type is set to 'schema'");
        $this->assertEquals("updatedata.csv", $this->import->file, "the file is set to 'updatedata.csv'");
        $this->assertEquals(81, $this->import->vocabId, "the vocabid is set to '81'");
        $this->assertTrue(is_integer($this->import->vocabId), "the vocabid is an integer");
        $this->assertEquals(
          Fixtures::get("importFolder")."updatedata.csv",
          $this->import->importFolder . $this->import->file,
          "the path is set"
        );
    }

    public function testOpenCsvFile()
    {
        $reader = $this->import->setCsvReader($this->import->file);
        verify(
          "Reading the file doesn't return an error",
          get_class($reader)
        )->equals("Ddeboer\\DataImport\\Reader\\CsvReader");
    }

    public function testPrologInitialization()
    {
        $this->import->setCsvReader($this->import->file);
        $this->import->processProlog();
        $prolog = $this->import->prolog;
        $this->assertEquals(16, count($prolog['columns']), "There are the correct number of columns");
        $this->assertEquals(15, count($prolog['prefix']), "There are the correct number of prefix entries");
        $this->assertEquals(9, count($prolog['meta']), "There are the correct number of meta entries");
        $this->assertEquals("4", $prolog['columns']["4"]["id"], "The columns have the correct ID");
        $this->assertEquals("type", $prolog['columns']["4"]["name"], "The columns have the correct name");
        $this->assertEquals("4", $prolog['columns']["4"]["property"]->getId(), "The columns have the correct property object");
        $this->assertEquals("27", $prolog['columns']["27 (en)"]["id"], "The columns have the correct ID");
        $this->assertEquals("lexicalAlias", $prolog['columns']["27 (en)"]["name"], "The columns have the correct name");
        $this->assertEquals("27", $prolog['columns']["27 (en)"]["property"]->getId(), "The columns have the correct property object");    }

}
