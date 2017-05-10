<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 6:59 PM */

namespace Tests\Unit\OMR;

use App\Services\Import\GoogleSpreadsheet;
use Spatie\Snapshots\MatchesSnapshots;
use Tests\TestCase;

class GoogleSpreadsheetTest extends TestCase
{
    use MatchesSnapshots;
    /**
     * @test
     */
    public function it_retrieves_a_set_of_worksheet_titles_from_a_google_spreadsheet()
    {
        //given a new google sheet class
        $sheetUrl = 'https://docs.google.com/spreadsheets/d/1fM26a68SScrDvIJfgtT4QS-Vmhxw_deNhBrPMmBWQkI/edit?usp=sharing';
        $sheet    = new GoogleSpreadsheet($sheetUrl);

        //when I get the worksheets
        $worksheets = $sheet->getWorksheets()->toArray();

        //then worksheets contains the following array
        $expected = [ 'RDACarrierType_en-fr_20170503T162715_483_0', 'RDAMaterial_en-fr_20170503T230849_484_0', 'rdai_en-fr_20170504T170250_542_0' ];
        $this->assertArraySubset($expected, $worksheets);
    }


    /**
     * @test
     */
    public function it_retrieves_the_data_for_a_worksheet()
    {
        //given a spreadsheet and worksheet title string
        $sheetUrl = 'https://docs.google.com/spreadsheets/d/1WTxiOvHHUurz76NZ0WU_2GjjY4SG8Gzbg0vH8xwNz_I/edit#gid=0';
        $sheet    = new GoogleSpreadsheet($sheetUrl);
        //when I request the data for a worksheet
        $data = $sheet->getWorksheetData('RDAMediaType_en-fr_20170508T205240_547_0')->toArray();
        //then i get the data back
        $this->assertMatchesSnapshot($data);
    }

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }
}
