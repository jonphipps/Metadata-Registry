<?php
  use Codeception\TestCase\Cest;
  use WebDev\AgentSteps;
  use WebDev\LoginSteps;

  /**
   * Class RegisterNewUserCest
   *
   * @guy WebDev\AgentSteps
   */
  class RegisterAgentCest {
    public function _before() {
    }

    public function _after() {
    }

    public function _failed(Cest $cest) {
    }

    // tests
    public function CreateNewAgent(AgentSteps $I) {
      $I->resizeWindow(800,600);
      $I->amOnPage('/');
      $I->makeScreenshot('Create Agent Start');
      $I->loginAsVocabAdmin();
      $I->waitForElement(".subcontent-unit-border-orange > ul:nth-child(4) > li:nth-child(1) > a:nth-child(2)", 5);
      $I->seeLink("(Add)");
      $I->click("(Add)");
      $I->waitForText("Creating new owner", 5);

      $I->canSeeElement(["css" => "input.sf_admin_action_list"]);

      $I->cantSeeElement(["css" => "input.sf_admin_action_edit"]);
      $I->cantSeeElement(["css" => 'a[title="Register a new vocabulary"]']);
      $I->cantSeeElement(["css" => 'a[title="Register a new Element Set"]']);

      $I->fillField(["id" => "agent_org_name"], AgentSteps::$agentData['org_name']);
      $I->fillField(["id" => "agent_org_email"], AgentSteps::$agentData['org_email']);
      $I->fillField(["id" => "agent_ind_affiliation"], AgentSteps::$agentData['ind_affiliation']);
      $I->fillField(["id" => "agent_address1"], AgentSteps::$agentData['address1']);
      $I->fillField(["id" => "agent_address2"], AgentSteps::$agentData['address2']);
      $I->fillField(["id" => "agent_city"], AgentSteps::$agentData['city']);
      $I->fillField(["id" => "agent_state"], AgentSteps::$agentData['state']);
      $I->fillField(["id" => "agent_postal_code"], AgentSteps::$agentData['postal_code']);
      $I->fillField(["id" => "agent_phone"], AgentSteps::$agentData['phone']);
      $I->fillField(["id" => "agent_web_address"], AgentSteps::$agentData['web_address']);
      $I->click("save");
      $I->waitForText("Your modifications have been saved");
      $I->seeInDatabase("reg_agent", AgentSteps::$agentData);
      $I->seeInDatabase("reg_agent_has_user", AgentSteps::$agentAdminData);

      //have the menu items been updated
      $I->canSeeElement(["css" => "input.sf_admin_action_edit"]);
      $I->canSeeElement(["css" => "input.sf_admin_action_list"]);
      $I->canSeeElement(["css" => 'a[title="Register a new vocabulary"]']);
      $I->canSeeElement(["css" => 'a[title="Register a new Element Set"]']);
      //$I->makeScreenshot('Create Agent');
      //is the member list correct
      $I->click(["css" => "#a1 > span"]);
      $I->waitForText("Vocab Admin");
      $I->seeInTitle("The Registry! :: Test Owner :: List Members");
      //$I->makeScreenshot('List Members');
      $I->canSeeLink("Vocab Admin");
      $I->canSeeLink("Test Owner");
      //see registrar tick
      $I->canSeeElement(['css'=>'img[alt="Tick"]']);
      //see administrator tick
      $I->canSeeElement(["xpath"=>"(//img[@alt='Tick'])[2]"]);
      //show the row
      $I->canSeeElement(['css' => 'img[alt="show"]']);
      //Add a new member
      $I->canSeeElement('.sf_admin_action_create');
    }

    /**
     * @param AgentSteps $I
     *
     * @depends CreateNewAgent
     *
     */
    public function AddNewMember(AgentSteps $I) {
      $I->amOnPage("/");
      $I->makeScreenshot('Add member Start');
      $I->loginAsVocabAdmin();
      //$I->haveInDatabase("reg_user", LoginSteps::$vocabAdminData);
      $I->seeInDatabase("reg_user", LoginSteps::$vocabAdminData);
      $I->seeInDatabase("reg_agent", AgentSteps::$agentData);
      $I->seeInDatabase("reg_agent_has_user", AgentSteps::$agentAdminData);
      //$I->loginAsVocabAdmin();
      $I->amOnPage("/agentuser/list/agent_id/1.html");
      $I->makeScreenshot("foo");
      $I->click("Add Member");
      $I->seeElement(["name" => "save"]);
      $I->seeElement(["css" => "input.sf_admin_action_cancel"]);
      $I->seeInTitle("The Registry! :: Adding member to Test Owner");
      $I->selectOption(["id" => "agent_has_user_user_id"], "Joe Admin");
      $I->uncheckOption(["id" => "agent_has_user_is_admin_for"]);
      $I->click("Save");
      $I->waitForText("Your modifications have been saved");
      $I->seeInDatabase("reg_agent_has_user", AgentSteps::$agentUserData);
      $I->seeElement(["css" => "input.sf_admin_action_delete"]);
      $I->seeElement(["css" => "input.sf_admin_action_edit"]);
      $I->seeElement(["css" => "input.sf_admin_action_create"]);
      $I->canSeeLink("Joe Admin");
      $I->canSeeInTitle('The Registry! :: Test Owner :: joeadmin :: Show Detail');
      $I->click('Members');
      $I->canSeeInTitle('The Registry! :: Test Owner :: List Members');
      //see registrar tick
      $I->cantSeeElement(['css'=>'.sf_admin_row_0 > td:nth-child(3) > img:nth-child(1)']);
      //see administrator tick
      $I->cantSeeElement(["css"=>".sf_admin_row_0 > td:nth-child(4) > img:nth-child(1)"]);
      $I->makeScreenshot("before click show");
      $I->click(["css" => 'img[alt="show"]']);
      $I->makeScreenshot("before click add");
      $I->click(["css" => 'a[title="Register a new vocabulary"]']);
      $I->makeScreenshot("done");


    }
  }
