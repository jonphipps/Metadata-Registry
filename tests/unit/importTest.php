<?php
use Codeception\Util\Stub;
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;

class importTest extends \Codeception\TestCase\Test
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
        $this->import = new ImportVocab("schema", "importdata.csv", 1);
        $this->import->importFolder = "/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/";
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
        $this->tester->canSeeInDatabase('reg_vocabulary', ['id' => 1, "agent_id" => 3]);
        $this->tester->canSeeInDatabase('reg_schema', ['id' => 1, "agent_id" => 3]);
        //verify("fixture file is readable", Fixtures::get("fixxy") == "../_data/dump.sql")->true();
    }

    public function testClass_initialized_properly()
    {
        $this->assertEquals("schema", $this->import->type, "the type is set to 'schema'");
        $this->assertEquals("importdata.csv", $this->import->file, "the file is set to 'importdata.csv'");
        $this->assertEquals(1, $this->import->vocabId, "the vocabid is set to '1'");
        $this->assertTrue(is_integer($this->import->vocabId), "the vocabid is an integer");
        $this->assertEquals(
          "/var/www/registry/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/importdata.csv",
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

    //testPrologProvision
    public function testProcessProlog()
    {
        $I = $this->tester;
        $this->tester->wantToTest("processing the prolog and importing the file into the database");
        $this->import->setCsvReader($this->import->file);
        $this->import->processProlog();
        $prolog = $this->import->prolog;
        $this->assertEquals(14, count($prolog['columns']), "There are the correct number of columns");
        $this->assertEquals(6, count($prolog['prefix']), "There are the correct number of prefix entries");
        $this->assertEquals(10, count($prolog['meta']), "There are the correct number of meta entries");
        $this->import->getDataColumnIds();
        $this->import->processData();
        $results = $this->import->results['success'];
        verify(
          "There were 8 rows processed",
          count($results['rows'])
        )->equals(12);
        $this->import->processParents();
        $I->seeRecordCountInDatabaseTable("SchemaPropertyElement", 140);
        $I->seeRecordCountInDatabaseTable("SchemaProperty", 12);
        //prolog namespace entries are readable
        //prolog headers are actually in row 1
        //prolog headers not in row 1 produce fatal error (logged)
        //prolog entries can be matched to database (column uri matched to profile id)
        //prolog entries that can't be matched produce fatal error (logged)
    } //
    //given a properly provisioned prolog
    //start reading from the first row of data
    //substitute fqn for prefix for all resource URIs
    //refuse to import cell using prefix with no fqn (log it to errors array)
    //check to see if the resource already exists in the database
    //  update if it does _and_ it's different (log it to errors array)
    //  insert if it doesn't (log it to errors array)
    //generate log report
}
