<?php

use Illuminate\Foundation\Testing\Concerns\InteractsWithPages;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class LoggedInRouteTest
 */
class DashboardTest extends TestCase
{
  use InteractsWithPages, DatabaseTransactions;



  /**
   * @test
   */
  public function a_guest_cannot_access_the_dashboard_and_sees_the_login_screen()
  {
    //given I am NOT logged in
    Auth::logout();

    $this->visit('dashboard')
         ->seePageIs('login');
  }


  /**
   * @test
   */
  public function logged_in_user_with_no_projects_sees_start_project_button_on_dashboard()
  {
    //given I am a registered user
    $this->actingAs($this->user)

    //when I go to dashboard
    ->visit('dashboard')
    //then I see a start project button
    ->see('Start by Adding a Project')
    ->see('Add New Project');
  }


  /**
   * @test
   */
  public function logout_returns_logged_in_user_to_homepage()
  {
    //given I am a registered user
    $this->actingAs($this->user)
         ->visit('dashboard')
         ->click('Logout')
         ->seePageIs('/');

  }

}
