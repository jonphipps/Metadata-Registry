<?php

  use WebDev\LoginSteps;

  /**
   * Class loginCest
   *
   * @guy WebDev\loginSteps
   */
  class loginCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function tryToTestLogin(LoginSteps $I, $scenario)
    {
      $I->wantTo('Log into site');
      $I->amOnPage('/');
      $I->loginAs("admin","admin");
      $I->click("admin profile");
      $I->see("admin","div.content");
      $I->canSeeInDatabase("reg_user",array("nickname"=>"admin","last_name"=>null, "first_name"=>null));
      $I->fillField("first_name","Joe");
      $I->fillField("#last_name","Admin");
      $I->click("update it");
      //$I->canSee("Joe","#first_name");
      //$I->canSee("Admin","#last_name");
      $I->canSee("Joe Admin's profile","h1");
      $I->seeInDatabase("reg_user",array("nickname"=>"admin","last_name"=>"Admin", "first_name"=>"Joe"));



    }
}
