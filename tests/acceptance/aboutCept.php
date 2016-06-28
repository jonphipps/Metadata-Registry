<?php

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the about page exists');
$I->amOnPage("/");

$I->seeResponseCodeIs(200);
$I->click('about', '#header');
$I->seeResponseCodeIs(200);
$I->canSeeInCurrentUrl('about');
$I->seeInTitle('about');
