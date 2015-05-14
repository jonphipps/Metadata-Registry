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
    public function testCodecep_setup()
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

    public function testClass_initialized_properly()
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

    public function testOpenFile()
    {
        $reader = $this->import->setCsvReader($this->import->file);
        verify(
          "Reading the file doesn't return an error",
          get_class($reader)
        )->equals("Ddeboer\\DataImport\\Reader\\CsvReader");
    }

}
