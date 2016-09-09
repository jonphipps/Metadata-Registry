<?php

use Step\Acceptance\Login;

/** @var \Codeception\Scenario $scenario */
$I = new Login($scenario);
$I->wantTo('want to login and add a new agent');
$I->amOnPage('/');
$I->loginAsAgentAdmin();
$I->seeElement('input',['value'=>'Add Agent']);
$I->click("Add Agent");
$I->seeInCurrentUrl('/agent/create');
$I->see('Creating new agent', 'h1');
$I->submitForm("#sf_admin_edit_form",
               [
                   'id'               => '',
                   'agent[org_name]'  => 'An Agent Name',
                   'agent[org_email]' => 'jphipps@madcreek.com'
               ],
               'Save');
$I->seeInCurrentUrl('');
$I->seeLink('An Agent Name');
$I->seeInTitle("The Registry! :: vocab_admin :: Home");
$I->click('An Agent Name');
$I->seeInTitle("The Registry! :: An Agent Name :: Edit");
$I->dontSeeInCurrentUrl('show');
$I->seeInCurrentUrl('agents/59');
$I->seeElement('div', '#tab_container');
$I->click('Edit');
$I->fillField("agent[web_address]", 'http://example.com');
$I->click('Save');
$I->seeInDatabase('reg_agent', [ 'id' => 59, 'web_address' => 'http://example.com' ]);
$I->see('Your modifications have been saved');
$I->seeInTitle("The Registry! :: vocab_admin :: Home");
$I->dontSeeInCurrentUrl('show');
$I->seeInCurrentUrl('agents/59');
$I->click('Edit');
$I->seeInCurrentUrl('agents/59/edit');
$I->click('Cancel');
$I->seeInTitle("The Registry! :: vocab_admin :: Home");
