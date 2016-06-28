<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the home page exists');
$I->amOnPage(Home::$URL);
$I->seeInTitle(Home::$pageTitle);
$I->see(Home::welcome(), Home::$elementWelcome);
$I->see(Home::latestActivity(), Home::$elementLatestActivity);
$I->see(Home::registryNews(), Home::$elementRegistryNews);
$I->see(Home::sideMenu(), Home::$elementSideMenu);
$I->see(Home::signin(), Home::$elementSignin);
$I->seeElement(Home::$elementSearchElementForm);
$I->seeElement(Home::$elementSearchVocabForm);

