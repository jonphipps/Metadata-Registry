<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Auth;
use Tests\BrowserKitTestCase;

class ViewProjectListTest extends BrowserKitTestCase
{
    //use DatabaseTransactions;

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

    protected function IAmNotLoggedIn()
    {
        Auth::logout();
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
