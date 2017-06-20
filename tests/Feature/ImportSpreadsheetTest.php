<?php

namespace Tests\Unit;

use App\Models\Project;
use Tests\Browser\Pages\ProjectPage;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\Traits\Authorize;
use Tests\Feature\Traits\ProjectTest;
use Tests\Traits\TestData;

class ImportSpreadsheetTest extends BrowserKitTestCase
{
    use ProjectTest;
    use DatabaseTransactions;

    public function testCreateAnImportBatch() {

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

    protected function IPressTheNextButton() {

        $this->press('Next');

    }

    protected function IAmOnTheWorksheetPage() {

        $this->assertPageLoaded(route('frontend.project.import.create', [ 'project' => $this->project->id, 'batch'=> '1', 'step' => 'worksheet']));
    }

    protected function ISeeANewBatchEntryInTheDatabase() {

        $this->markTestIncomplete('Time to code');

    }


}
