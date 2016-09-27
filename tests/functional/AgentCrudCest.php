<?php
use Page\AgentPage;

class AgentCrudCest
{

  private $postAttributes;


  public function __construct()
  {
    $this->postAttributes = [
      'title'      => 'Hello Universe',
      'body'       => 'You are so awesome',
      'created_at' => new DateTime(),
      'updated_at' => new DateTime()
    ];
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
    $agentPage->createPost([ 'title' => 'Hello world', 'body' => 'And greetings for all' ]);
    $I->seeCurrentUrlEquals($agentPage::$URL);
    $I->see('Hello world', '.table');
  }


  public function createAgentValidationFails(FunctionalTester $I, AgentPage $postsPage)
  {
    $postsPage->createPost();
    $I->seeCurrentUrlEquals($postsPage->route('/create'));
    $I->see('The body field is required.', '.error');
    $I->see('The title field is required.', '.error');
  }


  public function editAgent(FunctionalTester $I, AgentPage $postsPage)
  {
    $randTitle = "Edited at " . microtime();
    $id        = $I->haveRecord('posts', $this->postAttributes);
    $postsPage->editPost($id, [ 'title' => 'Edited at ' . $randTitle ]);
    $I->seeCurrentUrlEquals($postsPage->route("/$id"));
    $I->see('Show Post', 'h1');
    $I->see($randTitle);
    $I->dontSee('Hello Universe');
  }


  public function deleteAgent(FunctionalTester $I, AgentPage $postsPage)
  {
    $id = $I->haveInDatabase('posts', $this->postAttributes);
    $I->amOnPage($postsPage::$url);
    $I->see('Hello Universe');
    $postsPage->deletePost($id);
    $I->seeCurrentUrlEquals($postsPage::$url);
    $I->dontSee('Hello Universe');
  }
}
