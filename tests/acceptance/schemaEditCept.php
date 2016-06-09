<?php
use Step\Acceptance\admin;

$I = new admin($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/schema/show/id/81.html');
$I->seeInTitle('Show Detail');
$I->seeElement('input', [ 'value' => 'List' ]);
$I->dontSeeElement('input', [ 'title' => 'Edit' ]);
$I->login();
$I->seeInTitle('Show Detail');
$I->seeElement('input', [ 'title' => 'Edit' ]);
$I->click('Edit');
$I->seeInTitle('editing');
