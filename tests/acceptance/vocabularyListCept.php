<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the vocabulary page exists');
$I->amOnPage(Home::$URL);

$I->click('//*[@id="panel_default"]/div/ul/li[2]/a');
$I->canSeeInCurrentUrl('vocabulary/list');
$I->seeInTitle('The Registry! :: Vocabularies :: List');

