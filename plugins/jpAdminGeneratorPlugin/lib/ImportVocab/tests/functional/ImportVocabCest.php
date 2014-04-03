<?php
use \TestGuy;

class ImportVocabCest
{

    public function _before()
    {
    }

    public function _after()
    {
    }

    // tests
    public function tryToTest(TestGuy $I) {
        $I->canSeeInDatabase( 'reg_vocabulary',['id' => 8, "agent_id" => 51]);

    }

}
