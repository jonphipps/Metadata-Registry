<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('schema/list.html');
$I->seeInTitle('Element Sets');
