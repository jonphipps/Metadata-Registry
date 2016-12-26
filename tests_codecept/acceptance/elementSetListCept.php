<?php
use Page\Acceptance\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the empty element set list');
$I->amOnPage('/elementsets.html');
$I->canSeeInCurrentUrl('elementsets.html');
$I->seeInTitle('The Registry! :: Element Sets :: List');
$I->see('Element Sets','h1');
$I->dontSee('Filters');

