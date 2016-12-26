<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('register a new user');
$I->amOnPage('/');
$I->click('register');
$I->seeInCurrentUrl('login');
$I->fillField('nickname', 'vocab_admin');
$I->fillField('password', '12345');
$I->fillField('password_bis', '12345');
$I->fillField('email', 'jphipps@madcreek.com');
$I->fillField('new', true);
$I->click('sign in');
$I->seeLink('(Add)');
$I->seeLink('vocab_admin profile');
