<?php
use Page\Acceptance\Home;

$I = new AcceptanceTester($scenario);
$I->wantTo('see that the vocabulary page exists');
$I->amOnPage('/vocabularies.html');
$I->canSeeInCurrentUrl('vocabularies');
$I->seeInTitle('The Registry! :: Vocabularies :: List');
$I->see('Vocabularies', 'h1');
$I->dontSee('Filters');

