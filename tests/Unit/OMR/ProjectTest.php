<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\Access\User\User;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        $this->dontSetupDatabase();
        parent::setUp();
    }

    /**
     * @test
     */
    public function get_only_public_projects()
    {
        //given there are public and private projects
        $projectCount = Project::count();
        $project1     = factory(Project::class)->create([ 'is_private' => false ]);
        $project2     = factory(Project::class)->create([ 'is_private' => true ]);
        $this->assertEquals($projectCount + 2, Project::count());
        //when I request only public projects
        //then I don't see any private projects in the response
        $this->assertEquals($projectCount + 1, Project::public()->count());
        $this->assertEquals(1, Project::private()->count());
    }

    /** @test */
    public function get_maintainer_for_language()
    {
        //given a project with a language maintainer
        $project = create(Project::class);
        $user = create(User::class);
        $ProjectUser = create(
            ProjectUser::class,
            [
                'agent_id'        => $project->id,
                'user_id'           => $user->id,
                'is_maintainer_for' => true,
                'languages'         => serialize([ 'en', 'fr' ]),
            ]
        );
        //when I ask if user is a maintainer for a language for this project
        $this->assertTrue($ProjectUser->isMaintainerForLanguage('fr'));
        //then I get back the user
    }
}
