<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\ProjectUser;
use Tests\BrowserKitTestCase;
use function homeRoute;
use function htmlspecialchars;

class ProjectViewTest extends BrowserKitTestCase
{
    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

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
            ->see(htmlspecialchars($project->title))
            ->dontSee("projects/{$project->id}/edit");
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
            [
                'is_registrar_for' => true,
                'is_admin_for'     => true,
            ]);
        $this->seeInDatabase(ProjectUser::TABLE,
            [
                'is_registrar_for' => true,
                'is_admin_for'     => true,
                'agent_id'         => $project->id,
                'user_id'          => $this->user->id,
            ]);
        //check the list for editability
        $this->actingAs($this->user);
        $this->visit($this->baseUrl . '/projects')
            ->see($project->title);
        $this->visit($this->baseUrl . '/projects/' . $project->id)
            ->see(htmlspecialchars($project->title))
            ->see("projects/{$project->id}/edit");
        $this->visit($this->baseUrl . '/dashboard')
            ->see($project->title);
    }

    /**
     * @test
     */
    public function a_logged_in_user_cannot_edit_a_project_they_donnot_own()
    {
        $this->actingAs($this->user);
        $this->visit($this->baseUrl . '/projects/58')->see('NSDL Registry')->dontSee('projects/58/edit');
        $this->get($this->baseUrl . '/projects/58/edit')->seeStatusCode(302)->assertRedirectedToRoute(homeRoute());
    }
}
