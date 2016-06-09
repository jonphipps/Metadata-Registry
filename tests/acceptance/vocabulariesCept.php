<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('vocabulary/list.html');
$I->seeInTitle('Vocabularies');
