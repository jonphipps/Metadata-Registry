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

class ImportTest extends BrowserKitTestCase
{
    //use DatabaseTransactions;

    public function setUp()
    {
      $this->dontSetupDatabase();
      parent::setUp();
    }

    /** @test */
    public function a_spreadsheet_import_can_import_multiple_exports_at_the_project_level()
    {
        //given there are multiple exports for a project
        $import = factory(\App\Models\Import::class)->create();
        $export = Export::first();
        $export->imports()->attach($import);
        $project = Project::first();
        $project->imports()->attach($import);


        //when I ask for a list of all of the imports related to an export
        //then I can see that there are multiple imports
    }
}
