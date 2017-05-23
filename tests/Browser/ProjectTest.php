<?php

namespace Tests\Browser;

use App\Models\Project;
use function ddd;
use const false;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ProjectList;
use Tests\Browser\Pages\ProjectPage;
use Tests\DuskTestCase;

class ProjectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testProject()
    {
        /** @var Project $project */
        $project = factory( Project::class )->create(['is_private' => false]);
        $this->browse( function( Browser $browser ) use ( $project ) {
            $browser->visit( new ProjectList() )->assertSee( 'Projects' )->assertSee( $project->title );
            $browser->visit( new ProjectPage($project) )->assertSee( $project->title );
        } );
    }
}
