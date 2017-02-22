<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class LoggedInRouteTest
 */
class AuthTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    //
    //A logged in user will have permission to view and edit their account, but not delete it

    //A project admin will have all permissions for a project and its children and all languages
    //A project language admin will have all permissions for a project and its children for that language
    //A project language admin will NOT have permission to publish the project
    //A non-subscriber can view index and show only public projects and their children

    /**
     * @test
     */
    public function any_subscriber_will_have_permission_to_create_a_project()
    {
        //given I am NOT logged in
        Auth::logout();
        $this->assertTrue($this->user->cannot('create', \App\Models\Project::class));

        //acting as a user
        $this->actingAs($this->user);
        //I can create a project
        $this->assertTrue($this->user->can('create', \App\Models\Project::class));
        $this->visit('projects/create')->seeStatusCode(200);

        //but I can't create other things
        $this->assertTrue($this->user->cannot('create', \App\Models\Vocabulary::class));
        $this->assertTrue($this->user->cannot('create', \App\Models\ElementSet::class));
        $this->assertTrue($this->user->cannot('create', \App\Models\Access\User\User::class));
    }
    //A project admin will have all permissions for a project and its children and all languages

    /**
     * @test
     */
    public function the_creator_of_a_project_is_the_project_admin()
    {
        $project = factory(\App\Models\Project::class)->create();
        $this->user->projects()->attach($project,
            [
                'is_registrar_for' => true,
                'is_admin_for'     => true,
            ]);

        $this->seeInDatabase(\App\Models\ProjectHasUser::TABLE,
            [
                'is_registrar_for' => true,
                'is_admin_for'     => true,
                'agent_id'         => $project->id,
                'user_id'          => $this->user->id,
            ]);

        $this->visit("projects/$project->id")->seeStatusCode(200);

        $this->actingAs($this->user);
        $this->visit("projects/$project->id/edit")->seeStatusCode(200);
        //can't edit a project I don't own
        $project2 = factory(\App\Models\Project::class)->create();
        $response = $this->get("projects/$project2->id/edit")->seeStatusCode(403);

        //I can create a project
        $this->assertTrue($this->user->can('update', $project));
        //but I can also create other things
        $this->assertTrue($this->user->can('create', [\App\Models\Vocabulary::class, $project]));
        $this->assertTrue($this->user->can('create', [\App\Models\ElementSet::class, $project]));
    }
}
