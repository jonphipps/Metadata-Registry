<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-06-16,  Time: 9:47 AM */

namespace Tests\Feature\Traits;

use App\Models\Project;
use Tests\Browser\Pages\ProjectPage;
use Tests\Traits\TestData;

trait ProjectTest
{
    /** @var ProjectPage  */
    protected $projectPage;
    /** @var Project $project */
    protected $project;

    use Authorize, TestData;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
        $this->project     = Project::find(TestData::getTestData()['project']['id']);
        $this->projectPage = new ProjectPage($this->project);
    }

    protected function IAmOnAProjectPage()
    {
        $this->visit($this->projectPage->url());
    }
}
