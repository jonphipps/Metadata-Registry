<?php
use Step\Acceptance\admin;
use \Codeception\Util\Locator;

/** @var \Codeception\Scenario $scenario */
$I = new admin($scenario);
//$scenario->skip('not ready to test');
$I->wantTo('login and edit a schema description');
$I->amOnPage('/elementsets/');
$I->seeInTitle('Show detail');
$I->dontSeeElement('input', [ 'value' => 'List' ]);
$I->dontSeeElement('input', [ 'title' => 'Edit' ]);
$I->dontSeeElement('input', [ 'title' => 'Publish' ]);
$I->login();
$I->seeInTitle('Show detail');
$I->dontSeeElement('input', [ 'value' => 'List' ]);
$I->seeElement('input', [ 'title' => 'Edit' ]);
$I->seeElement('input', [ 'title' => 'Publish' ]);
$I->click('Edit',['class' => 'sf_admin_action_edit']);
$I->see('Editing', 'h1');
