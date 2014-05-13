<?php
  use WebDev\LoginSteps;

  /**
   * Class RegisterNewUserCest
   *
   * @guy WebDev\LoginSteps
   */
class RegisterNewUserCest
{
    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function tryToRegisterNewUser(LoginSteps $I)
    {
      $I->resizeWindow(800,600);
      $I->amOnPage('/');
      $I->click(LoginPage::$loginLinkText);
      $I->fillField(LoginPage::$usernameField,"vocabadmin");
      $I->fillField(LoginPage::$passwordField,"admin");
      $I->checkOption("new");
      $I->wait(1);
      $I->fillField(LoginPage::$passwordConfirmField,"admin");
      $I->fillField(LoginPage::$emailField,"vocab_admin@example.com");
      $I->click(LoginPage::$formSubmitButton);
      $I->canSeeLink("vocabadmin profile");
      $I->click("vocabadmin profile");
      $I->canSee("vocabadmin's profile","h1");
      $I->fillField("first_name","Vocab");
      $I->fillField("#last_name","Admin");
      $I->click("update it");
      //$I->canSee("Joe","#first_name");
      //$I->canSee("Admin","#last_name");
      $I->wait(2);
      $I->canSee("Vocab Admin's profile","h1");
      $I->seeInDatabase("reg_user",array("nickname"=>"vocabadmin","last_name"=>"Admin", "first_name"=>"Vocab", "email"=>"vocab_admin@example.com"));
      $I->logout();
    }
}
