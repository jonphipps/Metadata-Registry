<?php
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;
use Codeception\Module\Db;
use Codeception\Module\Dbh;
use Codeception\Module\DbHelper;
use Ddeboer\DataImport\Reader\ArrayReader;

require_once("_bootstrap.php");

class importUpdateTest extends \Codeception\TestCase\Test
{
    /*********************************
    /*
    /* deprecated -- moved to cest
    /*
    /*********************************

    /**
     * @var \ImportTester
     */
    protected $tester;

    /**
     * @var ImportVocab
     */
    protected $import;

    protected function _before()
    {
        $this->import = new ImportVocab("schema", "updatedata_nochange.CSV", 77);
        $this->import->importFolder = Fixtures::get("importFolder");
        $this->import->importId = 41;
    }

    protected function _after()
    {
    }

    // tests

    // These tests determine if an unchanged csv properly updates the db and records the correct history
    // It won't delete any data
    public function testSparseUpdate()
    {
        $I = $this->tester;

        $CsvHeader = "id,created_at,updated_at,deleted_at,created_user_id,updated_user_id,schema_id,name,label,definition,comment,type,is_subproperty_of,parent_uri,uri,status_id,language,note,domain,orange,is_deprecated,url,lexical_alias";
        $CsvValues = '"15368","2014-01-19 03:48:16","2015-05-29 18:47:56",,"422","422","77","creator","has creator","Relates a work to a person, family, or corporate body responsible for the creation of a work.",,"property","15039","http://rdaregistry.info/Elements/u/P60447","http://rdaregistry.info/Elements/w/P10065","1","en",,"http://rdaregistry.info/Elements/c/C10001","http://rdaregistry.info/Elements/c/C10002",,,';

        $correctData = $I->getArrayFromCsv($CsvHeader, $CsvValues, ['updated_at','deleted_at','created_user_id']);
        $I->wantToTest("if nothing in the main table gets changed");
        $this->import->setCsvReader($this->import->file);
        $this->import->processProlog();
        $this->import->getDataColumnIds();
        $results = $this->import->processData();
        verify("There were 1 rows processed",
          $results->getSuccessCount())->equals(1);
        //$this->import->processParents();
        foreach ($correctData as $key => $value) {
            $I->canSeeInDatabase('reg_schema_property', [$key => $value]);
        }

        $I->canSeeInDatabase('reg_schema_property', ['name' => 'creator', 'label' => "has creator"]);

    }
}
