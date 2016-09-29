<?php
use Page\Acceptance\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the login page exists');
$I->amOnPage(HomePage::$URL);

$I->click("sign in / register"); //login
$I->canSeeInCurrentUrl('login');
$I->seeInTitle('The Registry! :: sign in / register');

