<?php

namespace Tests\Browser;

use App\Models\Project;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ProjectList;
use Tests\DuskTestCase;

class ProjectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        /** @var Project $project */
        $project = factory( Project::class )->create();

        $this->browse( function( Browser $browser ) use ( $project ) {
            $browser->visit( new ProjectList() )->assertSee( 'Projects' )->assertSee( $project->label )->assertSee( 'NSDL' );
        } );
    }
}
