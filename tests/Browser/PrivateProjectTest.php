<?php

namespace Tests\Browser;

use App\Models\Project;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PrivateProjectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @test
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function private_projects_dont_appear_in_public_lists()
    {
        $this->markTestIncomplete('Not working correctly');
        /** @var Project $privateProject */
        $privateProject = factory(Project::class)->states('private')->create();
        /** @var Project $publicProject */
        $publicProject = factory(Project::class)->states('public')->create();

        $this->browse(function (Browser $browser) use ($privateProject, $publicProject) {
            $browser->visit('/projects')
                ->assertSee('Projects')
                ->pause(1000)
                ->assertDontSee($privateProject->title)
                ->assertSee($publicProject->title);
        });
    }
}
