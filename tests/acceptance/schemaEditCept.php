<?php
use Step\Acceptance\admin;
use \Codeception\Util\Locator;

$I = new admin($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/schema/show/id/81.html');
$I->seeInTitle('Show Detail');
$I->seeElement('input', [ 'value' => 'List' ]);
$I->dontSeeElement('input', [ 'title' => 'Edit' ]);
$I->dontSeeElement('input', [ 'title' => 'Publish' ]);
$I->login();
$I->seeInTitle('Show Detail');
$I->seeElement('input', [ 'title' => 'Edit' ]);
$I->seeElement('input', [ 'title' => 'Publish' ]);
$I->amOnPage('http://registry.dev/schema/edit/id/81.html');
$I->seeElement('input', [ 'title' => 'Save' ]);
