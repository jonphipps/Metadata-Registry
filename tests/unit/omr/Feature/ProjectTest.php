<?php

namespace Tests\Unit\Omr\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class LoggedInRouteTest
 */
class ProjectTestCase extends BrowserKitTestCase
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
  public function a_guest_sees_the_register_and_login_items_in_the_header()
  {
    /** @var Project $project */
    $project = factory(\App\Models\Project::class)->create();
    //given I am NOT logged in
    \Auth::logout();
    $this->visit('projects')
         ->see('Login')
         ->see('Register')
         ->see($project->created_at)
         ->see($project->org_name)
         ->dontseeElement('i.fa-save')
        ->see('Action')
         ->dontsee("/projects/$project->id/edit")
         ->dontseeElement('a.grid-row-delete', [ 'data-id' => $project->id ]);
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
    $this->visit('projects')
         ->see($project->created_at)
         ->see($project->org_name)
         ->dontSee($project2->org_name);
  }

}
