<?php

namespace Tests\Browser;

use App\Models\Project;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectTest extends DuskTestCase
{
  use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
      /** @var Project $project */
      $project = factory(Project::class)->create();

      $this->browse(function (Browser $browser) use ($project) {
        $browser->visit('/projects')
                    ->assertSee('Projects')
            // ->assertSee($project->label);
            ->assertSee('NSDL');
        });
    }
}
