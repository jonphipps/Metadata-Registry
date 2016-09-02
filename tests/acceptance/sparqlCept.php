<?php 
$I = new AcceptanceTester($scenario);
$scenario->skip();
$I->wantTo('perform actions and see result');
$I->amOnPage('endpoint.php');
$I->seeInTitle('SPARQL');
