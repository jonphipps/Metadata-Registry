<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\ProjectHasUser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectViewTest extends TestCase
{
  use DatabaseTransactions;
  //use DatabaseMigrations;

  /**
   * @test
   */
  public function i_can_add_a_project_to_the_database_and_view_it()
  {
    //given I add a project to the database and I'm logged out
    auth()->logout();
    /** @var Project $project */
    $project = factory(Project::class)->create();
    //when I go to the url
    $this->get($this->baseUrl . '/projects/' . $project->id)
        ->assertSeeText($project->org_name)
        ->assertDontSee("projects/{$project->id}/edit");
  }

  /**
   * @test
   */
  public function the_creator_of_a_project_is_the_project_admin()
  {
    /** @var Project $project */
    $project = factory(Project::class)->create();
    \DB::commit();
    $this->user->projects()->attach($project,
                                    [ 'is_registrar_for' => true,
                                      'is_admin_for'     => true, ]);
    $this->assertDatabaseHas(ProjectHasUser::TABLE,
                             [ 'is_registrar_for' => true,
                               'is_admin_for'     => true,
                               'agent_id'         => $project->id,
                               'user_id'          => $this->user->id, ]);
    //check the list for editability
    $this->actingAs($this->user);
    $this->get($this->baseUrl . '/projects')->assertSeeText($project->org_name)
        ->assertSee("/projects/{$project->id}/edit")
        ->assertDontSee('/projects/58/edit');
    $this->get($this->baseUrl . '/projects/' . $project->id)
        ->assertSeeText($project->org_name)
        ->assertSee("projects/{$project->id}/edit");
    $this->get($this->baseUrl . '/projects/' . $project->id)
        ->assertSeeText($project->org_name)
        ->assertDontSee('projects/58/edit');
    $this->get($this->baseUrl . '/dashboard' )->assertSee($project->org_name);
  }

}
