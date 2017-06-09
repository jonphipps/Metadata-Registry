<?php

namespace Tests\Feature\OMR;

use App\Models\Elementset;
use App\Models\Export;
use App\Models\Project;
use function factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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
