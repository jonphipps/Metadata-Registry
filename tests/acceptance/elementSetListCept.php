<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the home page exists');
$I->amOnPage(Home::$URL);
$I->seeInTitle(Home::$pageTitle);

$I->click('//*[@id="panel_default"]/div/ul/li[3]/a');
$I->canSeeInCurrentUrl('schema/list');
$I->seeInTitle('The Registry! :: Element Sets :: List');

