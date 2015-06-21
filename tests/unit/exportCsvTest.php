<?php

use Codeception\Specify;

class exportCsvTest extends \Codeception\TestCase\Test
{
    use Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var  ExportVocab */
    protected $export;
    protected function _before()
    {
        $this->export = new ExportVocab(1, 2);
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {
        $this->specify("It has a User object set from a userId supplied in the constructor", function(){

        });
        $this->specify("It has a Schema object set from a schemaId supplied in the constructor");
        $this->specify("It should retrieve a prolog as an array");
        $this->specify("it finds an array of prefixes");
        $this->specify("it finds an array of used columns");
        //generate a prolog from a profile
            //this should also generate a json schema
            //embed it in the header or
            //make it a separate file
        //generate data from statements for a vocab
            //export as csv
            //export as rdf
            //export as excel
            //fully populated or empty
    }

}