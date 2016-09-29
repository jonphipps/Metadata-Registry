<?php
use Page\AgentPage;

class AgentCrudCest
{

  private $agentAttributes;


  public function __construct()
  {
    $this->agentAttributes = [ 'title'      => 'Hello Universe',
                               'body'       => 'You are so awesome',
                               'created_at' => new DateTime(),
                               'updated_at' => new DateTime() ];
  }


  public function _before(FunctionalTester $I)
  {
  }


  public function _after(FunctionalTester $I)
  {
  }


  // tests
  public function createAgent(FunctionalTester $I, AgentPage $agentPage)
  {
    $agentPage->createAgent([ 'title' => 'Hello world',
                              'body'  => 'And greetings for all' ]);
    $I->seeCurrentUrlEquals($agentPage::$URL);
    $I->see('Hello world', '.table');
  }


  public function createAgentValidationFails(FunctionalTester $I, AgentPage $agentsPage)
  {
    $agentsPage->createAgent();
    $I->seeCurrentUrlEquals($agentsPage->route('/create'));
    $I->see('The body field is required.', '.error');
    $I->see('The title field is required.', '.error');
  }


  public function editAgent(FunctionalTester $I, AgentPage $agentsPage)
  {
    $randTitle = "Edited at " . microtime();
    $id        = $I->haveInDatabase('agents', $this->agentAttributes);
    $agentsPage->editAgent($id, [ 'title' => 'Edited at ' . $randTitle ]);
    $I->seeCurrentUrlEquals($agentsPage->route("/$id"));
    $I->see('Show Agent', 'h1');
    $I->see($randTitle);
    $I->dontSee('Hello Universe');
  }


  public function deleteAgent(FunctionalTester $I, AgentPage $agentsPage)
  {
    $id = $I->haveInDatabase('agents', $this->agentAttributes);
    $I->amOnPage($agentsPage::$url);
    $I->see('Hello Universe');
    $agentsPage->deleteAgent($id);
    $I->seeCurrentUrlEquals($agentsPage::$url);
    $I->dontSee('Hello Universe');
  }
}
