<?php
use Page\Acceptance\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the login page exists');
$I->amOnPage(HomePage::$URL);

$I->click('//*[@id="header"]/ul/li[1]/a'); //login
$I->canSeeInCurrentUrl('login');
$I->seeInTitle('The Registry! :: sign in / register');

