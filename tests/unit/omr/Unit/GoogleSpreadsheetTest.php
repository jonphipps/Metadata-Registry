<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 6:59 PM */

namespace App\Services\Import;


use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GoogleSpreadsheetTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_retrieves_a_set_of_worksheet_tiltes_from_a_google_spreadsheet ()
    {
        //given a new googlesheet class
        $sheetUrl = 'https://docs.google.com/spreadsheets/d/1fM26a68SScrDvIJfgtT4QS-Vmhxw_deNhBrPMmBWQkI/edit?usp=sharing';
        $sheet = new GoogleSpreadsheet($sheetUrl);

        //when I get the worksheets
        $worksheets = $sheet->getWorksheets()->toArray();
        $expected = ['RDACarrierType_en-fr_20170503T162715_483_0', 'RDAMaterial_en-fr_20170503T230849_484_0', 'rdai_en-fr_20170504T170250_542_0'];
        //then worksheets contains the following array
        $this->assertArraySubset($expected, $worksheets);

    }
}
