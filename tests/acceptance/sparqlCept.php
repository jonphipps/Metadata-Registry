<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('endpoint.php');
$I->seeInTitle('SPARQL');
