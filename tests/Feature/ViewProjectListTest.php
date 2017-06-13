<?php

namespace Tests\Unit;

use Tests\BrowserKitTestCase;
use Tests\Feature\Traits\Authorize;

class ViewProjectListTest extends BrowserKitTestCase
{
    //use DatabaseTransactions;
    use Authorize;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    public function testSeeTheList()
    {
        $this->IAmNotLoggedIn();
        $this->givenIAmOnTheProjectsPage();
        $this->thenIShouldSeeTheDefaultProject();
        $this->andIShouldNotSeeTheAddProjectButton();
    }

    protected function givenIAmOnTheProjectsPage()
    {
        $this->visit('/projects');
        $this->assertResponseOk();
    }

    protected function thenIShouldSeeTheDefaultProject()
    {
        $this->see('NSDL');
    }

    protected function andIShouldNotSeeTheAddProjectButton()
    {
        $this->dontSeeElement('Add New');
    }
}
