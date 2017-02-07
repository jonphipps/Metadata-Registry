<?php

namespace Tests\_support;

use Behat\Gherkin\Node\TableNode;

/**
 * Inherited Methods
 * @method void wantToTest( $text )
 * @method void wantTo( $text )
 * @method void execute( $callable )
 * @method void expectTo( $prediction )
 * @method void expect( $prediction )
 * @method void amGoingTo( $argumentation )
 * @method void am( $role )
 * @method void lookForwardTo( $achieveValue )
 * @method void comment( $description )
 * @method \Codeception\Lib\Friend haveFriend( $name, $actorClass = null )
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{

    use _generated\AcceptanceTesterActions;


  /**
   * @Given I am on :page
   */
    public function iAmOn($page)
    {
        $this->amOnPage($page);
    }


  /**
   * @Then I should see :string
   */
    public function iShouldSee($string)
    {
        $this->see($string);
    }


  /**
   * @Then I should not see :string
   */
    public function iShouldNotSee($string)
    {
        $this->dontSee($string);
    }


  /**
   * @Then     I fill in the following:
   *
   * @param TableNode $fields
   *
   * @internal param \Behat\Gherkin\Node\TableNode $tableNode
   */
    public function iFillInTheFollowing(TableNode $fields)
    {
        foreach ($fields->getRowsHash() as $field => $value) {
            $this->fillField($field, $value);
        }
    }


  /**
   * @Then I press :button
   */
    public function iPress($button)
    {
        $this->click($button);
    }


  /**
   * @Then I should be on :url
   *
   */
    public function iShouldBeOn($url)
    {
        //$foo = $this->grabRecord('App\Models\Access\User\User',[ 'id'=> 3 ]);
        $this->seeInCurrentUrl($url);
    }
}
