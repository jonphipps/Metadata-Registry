<?php

namespace Tests\Unit\Omr\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;
use Tests\TestCase;

/**
 * Class LoggedInRouteTest
 */
class ProjectTestCase extends TestCase
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
  public function a_guest_sees_the_register_and_login_items_in_the_header()
  {
    /** @var Project $project */
    $project = factory(\App\Models\Project::class)->create();
    //given I am NOT logged in
    \Auth::logout();
    $response = $this->get('projects');
    $this->assertFalse($response->isRedirect());
    $response->assertSee('Login')
             ->assertSee('Register')
             ->assertSee($project->org_name)
             ->assertdontsee('Action')
             ->assertdontsee("/projects/$project->id/edit");
  }

  /**
   * @test
   */
  public function a_guest_sees_public_projects_only()
  {
    /** @var Project $project */
    $project  = factory(\App\Models\Project::class)->create();
    $project2 = factory(\App\Models\Project::class)->create([ 'is_private' => true ]);
    //given I am NOT logged in
    \Auth::logout();
    $response = $this->get('projects')
                     ->assertsee($project->org_name)
                     ->assertDontSee($project2->org_name);
  }

}
