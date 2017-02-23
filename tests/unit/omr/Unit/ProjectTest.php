<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-02-22,  Time: 3:55 PM */

namespace tests\unit\omr\Unit;

use App\Models\Project;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProjectTest extends TestCase
{
  use DatabaseMigrations;

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
    $project1 = factory(Project::class)->create();
    $project2 = factory(Project::class)->create([ 'is_private' => true ]);
    //when I request only public projects
    //then I don't see any private projects in the response
    $this->assertEquals(1,
        Project::public()->count());
    $this->assertEquals(1,
        Project::private()->count());

  }

}
