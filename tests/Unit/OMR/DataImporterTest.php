<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-06,  Time: 5:21 PM */

namespace Tests\Unit\OMR;

use App\Services\Import\DataImporter;
use ExportHistory;
use function factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DataImporterTest extends TestCase
{

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }
    /**
     * @test
     */
    public function it_retrieves_an_associative_array_of_data_from_a_dataset_collection()
    {
        //given a set of normal raw csv-style data
        $data = collect([ [ 'reg_id', 'header B1' ], [ "data A2", "data B2" ] ]);
        $importer = new DataImporter($data);
        //when I request the data for a worksheet
        $importData = $importer->getDataForImport()->toArray();
        //then i get the data back
        $expected = [ '1' => [ 'reg_id' => 'data A2', 'header B1' => 'data B2' ] ];
        //ddd($data, $expected);
        $this->assertSame($expected, $importData);
    }

    /**
     * @test
     */
    public function it_retrieves_an_associative_array_of_data_for_a_dataset_that_has_no_regsitry_ids()
    {
        //given a set of normal raw csv-style data
        $data     = collect([ [ 'reg_id', 'header B1' ], [ "", "data B2" ] ]);
        $importer = new DataImporter($data);
        //when I request the data for a worksheet
        $importData = $importer->getDataForImport()->toArray();
        //then i get the data back
        $expected = [ '1' => [ 'reg_id' => '', 'header B1' => 'data B2' ] ];
        //ddd($data, $expected);
        $this->assertSame($expected, $importData);
    }

    /**
     * @test
     */
    public function it_retrieves_an_export_history_record_by_name()
    {
        //given we have a valid export history record
        //factory(ExportHistory::class);
        //when we ask for it from the database
        //then we get one
    }

}
