<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace Tests\Unit\OMR;

use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectTest extends TestCase
{

  use DatabaseTransactions;

  public function setUp()
  {
    //$this->dontSetupDatabase();
    parent::setUp();
  }

    /**
     * @test
     */
    public function get_only_public_projects()
    {
        //given there are public and private projects
        $projectCount = Project::count();
        $project1     = factory(Project::class)->create( [ 'is_private' => false ]);
        $project2     = factory(Project::class)->create([ 'is_private' => true ]);
        $this->assertEquals($projectCount + 2, Project::count());
        //when I request only public projects
        //then I don't see any private projects in the response
        $this->assertEquals($projectCount + 1, Project::public()->count());
        $this->assertEquals(1, Project::private()->count());
    }

}
