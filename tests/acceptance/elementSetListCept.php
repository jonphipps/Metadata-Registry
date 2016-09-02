<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the home page exists');
$I->amOnPage('/elementsets.html');
$I->canSeeInCurrentUrl('elementsets.html');
$I->seeInTitle('The Registry! :: Element Sets :: List');

