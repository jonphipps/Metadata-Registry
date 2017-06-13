<?php

namespace Tests\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Browser\Pages\ProjectPage;
use Tests\BrowserKitTestCase;
use Tests\Feature\Traits\Authorize;
use Tests\Traits\TestData;

class ProjectManagementTest extends BrowserKitTestCase
{
    private $projectPage;
    private $project;
    use DatabaseTransactions;
    use Authorize, TestData;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
        $this->project     = Project::find(self::getTestData()['project']['id']);
        $this->projectPage = new ProjectPage($this->project);
    }

    public function testEditTheProject()
    {
        $this->givenIAmTheProjectAdministrator();
        $this->andIAmOnAProjectPage();
        $this->whenIPressTheEditButton();
        $this->thenICanSeeTheEditProjectPage();
    }

    protected function andIAmOnAProjectPage()
    {
        $this->visit($this->projectPage->url());
    }

    protected function thenICanSeeTheEditProjectPage()
    {
        $this->assertPageLoaded($this->projectPage->url());
    }

    protected function whenIPressTheEditButton()
    {
        $this->click('Edit');
    }
}
