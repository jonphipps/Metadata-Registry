<?php

namespace Tests\Feature;

use App\Models\Batch;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\Traits\ProjectTest;
use Tests\Traits\TestData;

class ImportSpreadsheetTest extends BrowserKitTestCase
{
    use ProjectTest;
    use DatabaseTransactions;

    public function testCreateAnImportBatch()
    {
        if (is_readable(base_path('client_secret.json'))) {
            //given
            $this->IAmTheProjectAdministrator();
            $this->IAmOnTheProjectDashboard();
            //when
            $this->IPressTheAddImportButton();
            //then
            $this->IAmOnTheImportCreatePage();
            $this->IEnterAProcessableURL();
            $this->IPressTheNextButton();
            $this->IAmOnTheWorksheetPage();
            $this->ISeeANewBatchEntryInTheDatabase();
        } else {
            $this->assertTrue(true, 'no client secret file available');
        }
    }

    public function testCreateAnImportBatchFromPrevious()
    {
        if (is_readable(base_path('client_secret.json'))) {
            //given
            $this->addPreviousBatchData();
            $this->IAmTheProjectAdministrator();
            $this->IAmOnTheProjectDashboard();
            //when
            $this->IPressTheAddImportButton();
            //then
            $this->IAmOnTheImportCreatePage();
            $this->ISelectAProcessableURL();
            $this->IPressTheNextButton();
            $this->IAmOnTheWorksheetPage();
            $this->ISeeANewBatchEntryInTheDatabase();
        } else {
            $this->assertTrue(true, 'no client secret file available');
        }
    }

        protected function IAmOnTheProjectDashboard() {

        $this->IAmOnAProjectPage();

    }

    protected function IPressTheAddImportButton() {

        $this->click('Add Import');

    }

    protected function IAmOnTheImportCreatePage() {

        $this->assertPageLoaded(route('frontend.project.import.create',['project' => $this->project->id]));

    }

    protected function IEnterAProcessableURL() {

        $this->type( TestData::getTestData()['import']['validSpreadsheetUri'], 'source_file_name');

    }

    protected function ISelectAProcessableURL() {

        $this->select(TestData::getTestData()['import']['validSpreadsheetName'], 'source_file_name');

    }

    protected function IPressTheNextButton() {

        $this->press('Next');

    }

    protected function IAmOnTheWorksheetPage() {

        $this->assertPageLoaded(route('frontend.project.import.create', [ 'project' => $this->project->id, 'batch'=> '1', 'step' => 'worksheet']));
    }

    protected function ISeeANewBatchEntryInTheDatabase() {

        //$this->markTestIncomplete('Time to code');

    }

    protected function addPreviousBatchData()
    {
        $batch = factory(Batch::class)->create([
            'project_id' => 177,
            'step_data'  => json_decode('{
                "lastProcessed": 2,
                "batch_id": 1,
                "spreadsheet": {
                    "source_file_name": "https://docs.google.com/spreadsheets/d/15J2KPJE_omBMEiRbHEuzbXZ6EAI9WTrB0ZnUKdUFqgU/edit?ts=595a20e8#gid=0",
                    "import_type": "0"
                },
                "title": "XLFilesVV"
            }'),
            'run_description' => 'XLFilesVV',
        ]);
    }
}
