<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage("/");
$I->seeResponseCodeIs(200);
$I->seeInTitle("home");
