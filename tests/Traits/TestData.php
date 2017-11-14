<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-06-10,  Time: 10:37 AM */

namespace Tests\Traits;

trait TestData
{
    public static function getTestData(): array
    {
        $testData                                   = [];
        $testData['project']['adminId']             = 422;
        $testData['project']['id']                  = 177;
        $testData['project']['title']               = 'ALA Publishing';
        $testData['vocabulary']['id']               = 37;
        $testData['vocabulary']['title']            = 'RDA Media Type';
        $testData['vocabulary']['importId']         = 456;
        $testData['vocabulary']['exportId']         = 571;
        $testData['vocabulary']['maintainerId']     = 32;
        $testData['concept']['id']                  = 475;
        $testData['concept']['preferredLabelId']    = 1281;
        $testData['concept']['title']               = 'audio';
        $testData['elementSet']['id']               = 83;
        $testData['elementSet']['title']            = 'RDA Classes';
        $testData['elementSet']['importId']         = 451;
        $testData['element']['id']                  = 14329;
        $testData['element']['label']               = 'agent';
        $testData['statement']['id']               = 107705;
        $testData['statement']['object']           = 'agent';
        $testData['history']['id']                  = 223712;
        $testData['import']['validSpreadsheetUri']  = 'https://docs.google.com/spreadsheets/d/1WTxiOvHHUurz76NZ0WU_2GjjY4SG8Gzbg0vH8xwNz_I/edit#gid=0';
        $testData['import']['validSpreadsheetName'] = 'Registry tests';

        return $testData;
    }
}
