<?php

namespace Tests\Feature\OMR;

use App\Models\Access\User\User;
use App\Models\Project;
use App\Models\Vocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectDashboardTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /** @test */
    public function ProjectDashboardTests()
    {
        /** @var User $user */
        $user = factory(User::class)->create();

        /** @var Project $publicProject */
        $publicProject = factory(Project::class)->states('public')->create([ 'created_by' => $user->id, ]);
        $user->projects()->attach($publicProject->id);

        /** @var Project $privateProject */
        $privateProject = factory(Project::class)->states('private')->create([ 'created_by' => $user->id, ]);
        $user->projects()->attach($privateProject->id);

        /** tests */
        $this->as_a_guest_I_can_see_the_project_dashboard($publicProject);
        $this->as_a_guest_I_can_NOT_see_the_project_dashboard_of_a_PRIVATE_project($privateProject);
        $this->as_a_registered_user_I_can_see_the_project_dashboard_of_a_public_project_I_dont_own($publicProject);
        $this->if_there_are_no_vocabularies_or_element_sets_there_should_be_no_add_release_or_add_import_buttons(
            $publicProject,
            $user
        );
        $this->if_there_ARE_vocabularies_or_element_sets_there_should_be_an_add_release_and_add_import_buttons($publicProject, $user);

        //todo:fix this test
        $this->markTestIncomplete('This should be implemented in middleware');
        $this->as_a_registered_user_I_can_NOT_see_the_project_dashboard_of_a_PRIVATE_project_I_dont_own($privateProject);
    }

    private function as_a_guest_I_can_see_the_project_dashboard($publicProject)
    {
        $this->visit("/projects/{$publicProject->id}")
            ->see($publicProject->title)
            ->dontSee('Add Vocabulary')
            ->dontSee('Add Element Set')
            ->dontSee('Add Release')
            ->dontSee('Add Import');
    }

    private function as_a_guest_I_can_NOT_see_the_project_dashboard_of_a_PRIVATE_project($privateProject)
    {
        $this->get("/projects/{$privateProject->id}")->assertResponseStatus(404);
    }

    private function as_a_registered_user_I_can_see_the_project_dashboard_of_a_public_project_I_dont_own($publicProject)
    {
        $this->actingAs($this->user)
            ->visit("/projects/{$publicProject->id}")
            ->see($publicProject->title)
            ->dontSee('Add Vocabulary')
            ->dontSee('Add Element Set')
            ->dontSee('Add Release')
            ->dontSee('Add Import');
    }

    public function if_there_are_no_vocabularies_or_element_sets_there_should_be_no_add_release_or_add_import_buttons($publicProject, $user): void
    {
        $this->actingAs($user)
            ->visit("/projects/{$publicProject->id}")
            ->seeLink('Add Vocabulary')
            ->seeLink('Add Element Set')
            ->dontSeeLink('Add Release')
            ->dontSeeLink('Add Import');
    }
    public function if_there_ARE_vocabularies_or_element_sets_there_should_be_an_add_release_and_add_import_buttons(Project $publicProject, $user): void
    {
        $vocabulary = factory(Vocabulary::class)->create(['agent_id' => $publicProject->id]);
        $this->assertCount(1, $publicProject->vocabularies);
        $this->actingAs($user)
            ->visit("/projects/{$publicProject->id}")
            ->seeLink('Add Vocabulary')
            ->seeLink('Add Element Set')
            ->seeLink('Add Release')
            ->seeLink('Add Import');
    }

    private function as_a_registered_user_I_can_NOT_see_the_project_dashboard_of_a_PRIVATE_project_I_dont_own($privateProject)
    {
        $this->actingAs($this->user)->visit("/projects/{$privateProject->id}")->assertResponseStatus(403);
    }
}
