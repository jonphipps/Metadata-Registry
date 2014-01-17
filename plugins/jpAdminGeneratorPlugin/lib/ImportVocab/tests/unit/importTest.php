<?php
use Codeception\Util\Stub;
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;

class importTest extends \Codeception\TestCase\Test
{
    /**
     * @var \CodeGuy
     */
    protected $codeGuy;

    /**
     * @var ImportVocab
     */
    protected $import;

    protected function _before()
    {
        $this->import               = new ImportVocab("schema", "importdata.csv", 1);
        $this->import->importFolder =
          "/var/www/registry.dev/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/";
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
        $this->codeGuy->canSeeInDatabase('reg_vocabulary', ['id' => 8, "agent_id" => 52]);
        verify("fixture file is readable", Fixtures::get("fixxy") == "../_data/dump.sql")->true();
    }

    public function testclass_initialized_properly()
    {
        $this->assertEquals("schema", $this->import->type, "the type is set to 'schema'");
        $this->assertEquals("importdata.csv", $this->import->file, "the file is set to 'importdata.csv'");
        $this->assertEquals(1, $this->import->vocabId, "the vocabid is set to '1'");
        $this->assertTrue(is_integer($this->import->vocabId), "the vocabid is an integer");
        $this->assertEquals(
             "/var/www/registry.dev/plugins/jpAdminGeneratorPlugin/lib/ImportVocab/tests/_data/importdata.csv",
               $this->import->importFolder . $this->import->file,
               "the path is set"
        );
    }

    public function testOpenFile()
    {
        $reader = $this->import->setCsvReader($this->import->file);
        verify(
          "Reading the file doesn't return an error",
          get_class($reader) == "Ddeboer\\DataImport\\Reader\\CsvReader"
        )->true();
    }

    //testPrologProvision
    public function testProcessProlog()
    {
        $this->import->setCsvReader($this->import->file);
        $this->import->processProlog();
        $prolog    = $this->import->prolog;
        $jsonmatch =
          '{"columns":{"lang":[],"meta":{"lang":"lang","type":"type"},"key":{"lang":"en","type":"uri"},"owl:sameAs":{"lang":"","type":"uri"},"rdfs:label":{"lang":"en","type":""},"skos:definition":{"lang":"en","type":""},"skos:scopeNote":{"lang":"en","type":""},"rdfs:domain":{"lang":"","type":"uri"},"rdfs:range":{"lang":"","type":"uri"},"rdfs:subPropertyOf":{"lang":"","type":"uri"},"owl:inverseOf":{"lang":"","type":"uri"},"reg:name":{"lang":"","type":""},"reg:type":{"lang":"","type":""},"type":[]},"meta":{"token":"rdai","label":"RDA item properties","status_id":"1","url":"","note":"","tags":"","base_domain":"http:\/\/rdavocab.info\/Elements\/item\/","type":"schema","agent_id":"63","user_id":"63"},"prefix":{"owl":"http:\/\/www.w3.org\/2002\/07\/owl#","rdfs":"http:\/\/www.w3.org\/2000\/01\/rdf-schema#","skos":"http:\/\/www.w3.org\/2004\/02\/skos\/core#","rdaa":"http:\/\/rdavocab.info\/Elements\/a\/","rdac":"http:\/\/rdavocab.info\/Elements\/c\/","rdae":"http:\/\/rdavocab.info\/Elements\/e\/","rdai":"http:\/\/rdavocab.info\/Elements\/i\/","rdam":"http:\/\/rdavocab.info\/Elements\/m\/","rdau":"http:\/\/rdavocab.info\/Elements\/u\/","rdaw":"http:\/\/rdavocab.info\/Elements\/w\/"}}';
        $this->assertEquals(12, count($prolog['columns']), "There are the correct number of columns");
        $this->assertEquals(12, count($prolog['prefix']), "There are the correct number of prefix entries");
        $this->assertEquals(10, count($prolog['meta']), "There are the correct number of meta entries");
        //verify("Reading prolog produces the correct array", json_encode($prolog)==$jsonmatch)->true();
        $this->import->getDataColumnIds();
        $this->import->processData();
        $this->import->processParents();

        //prolog namespace entries are readable
        //prolog headers are actually in row 1
        //prolog headers not in row 1 produce fatal error (logged)
        //prolog entries can be matched to database (column uri matched to profile id)
        //prolog entries that can't be matched produce fatal error (logged)
    } //

    //testProvision
    //given a properly provisioned prolog
    //start reading from the first row of data
    //substitute fqn for prefix for all resource URIs
    //refuse to import cell using prefix with no fqn (log it to errors array)
    //check to see if the resource already exists in the database
    //  update if it does _and_ it's different (log it to errors array)
    //  insert if it doesn't (log it to errors array)
    //generate log report

}
