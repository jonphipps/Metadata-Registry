<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-10-06,  Time: 1:48 PM */

namespace Tests\Unit\Traits;

trait UsesWorksheetData
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private function getVocabularyWorksheetData()
    {
        return include __DIR__ . '/../OMR/__snapshots__/GoogleSpreadsheetTest__it_retrieves_the_data_for_a_worksheet__1.php';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    private function getElementSetWorksheetData()
    {
        return include __DIR__ .
            '/../OMR/__snapshots__/GoogleSpreadsheetTest__it_retrieves_the_data_for_an_elementset_worksheet__1.php';
    }
}
