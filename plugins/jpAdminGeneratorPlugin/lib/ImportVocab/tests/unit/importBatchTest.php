<?php

use Codeception\Util\Stub;
use Codeception\Util\Fixtures;
use ImportVocab\ImportVocab;

class importBatchTest extends \Codeception\TestCase\Test
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
    }

    protected function _after()
    {
    }

    // tests
    public function testProcessBatch()
    {
        $results   = array();
        $folder    = "/var/www/registry.dev/web/uploads/";
        $fileArray = array(
          'rdaelementsetuploadfinal - Agent.csv'         => '81',
          'rdaelementsetuploadfinal - Expression.csv'    => '78',
          'rdaelementsetuploadfinal - FRClasses.csv'     => '83',
          'rdaelementsetuploadfinal - Item.csv'          => '80',
          'rdaelementsetuploadfinal - Manifestation.csv' => '79',
          'rdaelementsetuploadfinal - Unconstrained.csv' => '82',
          'rdaelementsetuploadfinal - Work.csv'          => '77'
        );
        foreach ($fileArray as $file => $id) {
            $import               = new ImportVocab("schema", $file, $id);
            $import->importFolder = $folder;
            $import->setCsvReader($import->file);
            $import->processProlog();
            $import->getDataColumnIds();
            $import->processData();
            //todo: $results should be a class
            $results[$id] = $import->results;
        }

        foreach ($results as $id => $result) {
            //FIXME: this is a terrible way to do this
            $import->reader     = new \Ddeboer\DataImport\Reader\ArrayReader($result['success']['rows']);
            $import->vocabulary = $id;
            $import->processParents();
        }
    } //

    //generate log report

}
