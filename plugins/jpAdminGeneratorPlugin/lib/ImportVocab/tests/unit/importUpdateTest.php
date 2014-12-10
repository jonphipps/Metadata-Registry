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
        $this->import = new ImportVocab("schema", "updatedata.csv", 1);
        $this->import->importFolder = "/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/";
        $this->tester->resetDatabase('swregistry_test_update.sql');
    }

    protected function _after()
    {
    }

    // tests
    public function testCodecep_setup()
    {
        echo var_dump(get_class($this->import));
        verify(
          "ImportVocab is a class = " . get_class($this->import),
          get_class($this->import) == 'ImportVocab\ImportVocab'
        )->true();
        $this->tester->canSeeInDatabase('reg_schema_property', ['id' => 1, "name" => 'subjectTo']);
        $this->tester->canSeeInDatabase('reg_schema_property_element', ['id' => 1, "object" => 'subjectTo']);
        $this->tester->canSeeInDatabase('reg_schema_property_element_history', ['id' => 1, "object" => 'subjectTo']);
    }

    public function testClass_initialized_properly()
    {
        $this->assertEquals("schema", $this->import->type, "the type is set to 'schema'");
        $this->assertEquals("updatedata.csv", $this->import->file, "the file is set to 'updatedata.csv'");
        $this->assertEquals(1, $this->import->vocabId, "the vocabid is set to '1'");
        $this->assertTrue(is_integer($this->import->vocabId), "the vocabid is an integer");
        $this->assertEquals(
          "/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/updatedata.csv",
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

    // These tests determine if a changed csv properly updates the db and records the correct history
    // It won't delete any data
    public function testSparseUpdate()
    {
        $I=$this->tester;
        $I->wantToTest("if a changed cell in the main table gets changed");
        $I->seeRecordCountInDatabaseTable("SchemaPropertyElement", 92);
        $I->seeRecordCountInDatabaseTable("SchemaProperty", 8);
        $I->seeRecordCountInDatabaseTable("SchemaPropertyElementHistory", 96);
        $I->canSeeInDatabase('reg_schema_property', ['id' => 1, "definition" => "This property associates a publication, i.e. an instance of F3 Manifestation Product Type, with an instance of E30 Right, which applies to all exemplars of that publication, as long as they are recognised as exemplars of that publication."]);
        $this->import->setCsvReader($this->import->file);
        $this->import->processProlog();
        $prolog    = $this->import->prolog;
        $this->assertEquals(14, count($prolog['columns']), "There are the correct number of columns");
        $this->assertEquals(6, count($prolog['prefix']), "There are the correct number of prefix entries");
        $this->assertEquals(10, count($prolog['meta']), "There are the correct number of meta entries");
        $this->import->getDataColumnIds();
        $this->import->processData();
        $results = $this->import->results['success'];
        verify("There were 8 rows processed",
          count($results['rows']))->equals(8);
        $this->import->processParents();
        $I->canSeeInDatabase('reg_schema_property', ['id' => 1, "definition" => "fubar, baby"]);

        //test if a changed cell in the main table gets changed in the statement table
        $I->canSeeInDatabase('reg_schema_property_element', ['id' => 3, "object" => "fubar, baby"]);
        //test if the history is updated
        $I->canSeeInDatabase('reg_schema_property_element_history', ['schema_property_element_id' => 3, 'schema_property_id' => 1, "object" => "fubar, baby"]);
        $historyDate = $I->grabFromDatabase('reg_schema_property_element_history', 'created_at', ['schema_property_element_id' => 3, 'schema_property_id' => 1, "object" => "fubar, baby"]);
        //the other rows haven't been updated
        $updateDate = $I->grabFromDatabase('reg_schema_property', 'updated_at', ['id' => 3]);
        verify("another property row hasn't been updated",
          $historyDate)->greaterThan($updateDate);
        $elementUpdateDate = $I->grabFromDatabase('reg_schema_property_element', 'updated_at', ['id' => 3]);
        verify("the element row has been updated",
          $historyDate)->equals($elementUpdateDate);
        $otherPropertyUpdateDate = $I->grabFromDatabase('reg_schema_property_element', 'updated_at', ['id' => 12]);
        verify("the inverse property statement has not been updated",
          $historyDate)->greaterThan($otherPropertyUpdateDate);
        //test if a changed cell that exists only in the statement table gets changed in the statement table
        //test if the history is updated
        //test if a NEW cell in the main table gets sdded
        //test if a NEW cell in the main table gets changed in the statement table
        //test if the history is updated
        //test if a NEW cell that exists only in the statement table gets added to the statement table
        //test if the history is updated
    }
}
