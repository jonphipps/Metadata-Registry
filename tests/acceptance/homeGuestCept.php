<?php
use Page\Acceptance\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the home page exists');
$I->amOnPage(HomePage::$URL);
$I->seeInTitle(HomePage::$pageTitle);
$I->see(HomePage::welcome(), HomePage::$elementWelcome);
$I->see(HomePage::latestActivity(), HomePage::$elementLatestActivity);
$I->see(HomePage::registryNews(), HomePage::$elementRegistryNews);
$I->see(HomePage::signin(), HomePage::$elementSignin);
$I->seeElement(HomePage::$elementSearchElementForm);
$I->seeElement(HomePage::$elementSearchVocabForm);

