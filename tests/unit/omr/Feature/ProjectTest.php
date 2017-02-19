<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\BrowserKitTestCase;

/**
 * Class LoggedInRouteTest
 */
class ProjectTest extends BrowserKitTestCase
{
  use DatabaseTransactions;



  /**
   * @test
   */
  public function a_guest_sees_the_register_and_login_items_in_the_header()
  {
    //given I am NOT logged in
    Auth::logout();

    $this->get('projects')
        ->seePageIs('projects')
        ->assertResponseStatus(200)
        ->see('Login')
        ->see('Register');
  }




}
