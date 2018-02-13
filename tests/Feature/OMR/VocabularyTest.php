<?php

namespace Tests\Feature\OMR;

use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VocabularyTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function no_tests_yet()
    {
        $this->visit(route('frontend.index'));
        $this->assertPageLoaded(route('frontend.index'));
    }
}
