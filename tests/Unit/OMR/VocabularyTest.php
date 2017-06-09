<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\ConceptAttribute;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VocabularyTest extends TestCase
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
        $this->seed('RDAMediaTypeSeeder');
        $date = ConceptAttribute::getLatestDateForVocabulary(37);
        $this->assertSame((string) $date, '2015-10-29 11:09:17');
    }
}
