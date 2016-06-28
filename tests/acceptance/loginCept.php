<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the login page exists');
$I->amOnPage(Home::$URL);

$I->click('//*[@id="header"]/ul/li[1]/a'); //login
$I->canSeeInCurrentUrl('login');
$I->seeInTitle('The Registry! :: sign in / register');

