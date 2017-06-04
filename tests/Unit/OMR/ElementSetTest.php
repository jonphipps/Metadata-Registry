<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\ElementAttribute;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ElementSetTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function can_get_the_last_updated_statement()
    {
        $this->seed('RDAClassesSeeder');
        $date = ElementAttribute::getLatestDateForElementSet(83);
        $this->assertSame($date, '2017-02-10 11:58:57');
    }
}
