<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the home page exists');
$I->amOnPage(Home::$URL);

$I->click('//*[@id="panel_default"]/div/ul/li[4]/a');
$I->canSeeInCurrentUrl('endpoint');
$I->seeInTitle('ARC SPARQL+ Endpoint');
