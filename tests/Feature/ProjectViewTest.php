<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\ProjectHasUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectViewTest extends TestCase
{
  use DatabaseTransactions;

  /**
   * @test
   */
  public function i_can_add_a_project_to_the_database_and_view_it()
  {
    //given I add a project to the database
    /** @var Project $project */
    $project = factory(Project::class)->create();
    //when I go to the url
    $this->get($this->baseUrl . '/projects/' . $project->id)->assertSee($project->org_name);
  }

  /**
   * @test
   */
  public function the_creator_of_a_project_is_the_project_admin()
  {
    /** @var Project $project */
    $project = factory(Project::class)->create();
    $this->actingAs($this->user);
    $this->user->projects()->attach($project,
                                    [ 'is_registrar_for' => true,
                                      'is_admin_for'     => true, ]);
    $this->assertDatabaseHas(ProjectHasUser::TABLE,
                             [ 'is_registrar_for' => true,
                               'is_admin_for'     => true,
                               'agent_id'         => $project->id,
                               'user_id'          => $this->user->id, ]);
    $this->get($this->baseUrl . '/projects')->assertSee($project->org_name);
    $this->get($this->baseUrl . '/projects/' . $project->id)->assertSee($project->org_name)->assertSee('/projects/59/edit');
    $this->get($this->baseUrl . '/dashboard' )->assertSee($project->org_name);
  }

}
