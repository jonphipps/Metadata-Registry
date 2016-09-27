<?php
use Page\Acceptance\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the agent list page exists');
$I->amOnPage(HomePage::$URL);

$I->click('//*[@id="panel_default"]/div/ul/li[1]/a');
$I->canSeeInCurrentUrl('agents');
$I->seeInTitle('The Registry! :: Agents :: List');
