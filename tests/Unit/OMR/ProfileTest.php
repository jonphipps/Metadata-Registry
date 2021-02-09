<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\Profile;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    //use DatabaseTransactions;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function get_property_by_column_heading()
    {
        //given a profile and a column heading
        $profile = Profile::find(2);

        //repeatable with language
        $header  = 'alternative label[1]_fr';
        $testMap = [ 'id' => '34', 'label' => $header, 'language' => 'fr', 'object' => 0, 'required'=> 0 ];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);

        //required repeatable with language
        $header  = '*preferred label[0]_en';
        $testMap = [ 'id' => '45', 'label' => $header, 'language' => 'en', 'object' => 0, 'required' => 1];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);

        //required not repeatable no language
        $header  = '*status';
        $testMap = [ 'id' => '59', 'label' => $header, 'language' => '', 'object' => 1, 'required' => 0];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);

        //not required not repeatable with language
        $header  = 'ToolkitLabel_en';
        $testMap = [ 'id' => '61', 'label' => $header, 'language' => 'en', 'object' => 0, 'required' => 0];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);

        //not required not repeatable no language
        $header  = 'ToolkitLabel_en';
        $testMap = [ 'id' => '61', 'label' => $header, 'language' => 'en', 'object' => 0, 'required' => 0];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);
        //given a profile and a column heading

        $profile = Profile::find(1);

        //not repeatable, not required, no language
        $header  = 'domain';
        $testMap = [ 'id' => '11', 'label' => $header, 'language' => '', 'object' => 1, 'required' => 0];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);

        //repeatable, not required, no language
        $header  = 'subPropertyOf[0]';
        $testMap = [ 'id' => '6', 'label' => $header, 'language' => '', 'object' => 1, 'required' => 0];
        $map     = $profile->getColumnMapFromHeader($header);
        //then I should get a column header map returned
        self::assertEquals($testMap, $map);
    }
}
