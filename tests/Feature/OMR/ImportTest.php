<?php
/** @noinspection ReturnTypeCanBeDeclaredInspection */
namespace Tests\Feature\OMR;

use App\Models\Elementset;
use App\Models\Export;
use App\Models\Import;
use App\Models\Project;
use Carbon\Carbon;
use function factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
      $this->dontSetupDatabase();
      parent::setUp();
    }

    /** @test */
    public function a_spreadsheet_import_can_import_multiple_exports_at_the_project_level()
    {
        //given there are multiple exports for a project
        $import  = factory(Import::class)->create([ 'created_at' => Carbon::now()->subDay(2) ]);
        $import2 = factory(Import::class)->create([ 'created_at' => Carbon::now() ]);
        $export  = Export::first();
        $export->addImports([ $import, $import2 ]);
        $project = Project::first();
        $project->imports()->attach([ $import->id, $import2->id ]);

        //when I ask for a list of all of the imports related to an export
        $AllImports     = $export->imports;
        $projectImports = $project->imports;
        //then I can see that there are multiple imports
        $this->assertCount(2, $projectImports);
        $this->assertCount(2, $AllImports);
    }

    /** @test */
    public function I_can_get_the_latest_import_for_an_export()
    {
        //there are no imports yet
        /** @var Export $export */
        $export       = create(Export::class);
        $latestImport = $export->getLatestImport();
        $this->assertNull($latestImport);

        //given there are multiple imports fro an export
        $import  = create(Import::class, [ 'created_at' => Carbon::now()->subDay(2) ]);
        $import2 = create(Import::class, [ 'created_at' => Carbon::now() ]);
        $export->addImports([ $import, $import2 ]);

        //and I can get the latest one
        $latestImport = $export->getLatestImport();
        $this->assertSame($latestImport->id, $import2->id);
    }
}
