<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;
use Tests\Feature\Traits\ProjectTest;

class ProjectManagementTest extends BrowserKitTestCase
{
    use DatabaseTransactions;
    use ProjectTest;

    public function testEditTheProject()
    {
        //given
        $this->IAmTheProjectAdministrator();
        //and
        $this->IAmOnAProjectPage();
        //when
        $this->IPressTheEditButton();
        //then
        $this->ICanSeeTheEditProjectPage();
    }

    protected function ICanSeeTheEditProjectPage()
    {
        $this->assertPageLoaded($this->projectPage->url());
    }

    protected function IPressTheEditButton()
    {
        $this->click('Edit');
    }
}
