<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('register a new user');
$I->amOnPage('/');
$I->click('register');
$I->seeInCurrentUrl('login');
//$I->fillField('nickname', 'vocab_admin');
//$I->fillField('password', '12345');
//$I->fillField('password_bis', '12345');
//$I->fillField('email', 'jphipps@madcreek.com');
//$I->checkOption('new');
//$I->click('sign in');
$I->submitForm('#login_form',
               [
                   'nickname'     => 'vocab_admin',
                   'password'     => '12345',
                   'password_bis' => '12345',
                   'email'        => 'jphipps@madcreek.com',
                   'new'          => true,
                   'action'       => 'add'
               ],
               'commit');
$I->dontSeeInCurrentUrl('login');
$I->seeLink('(Add)');
$I->seeLink('vocab_admin profile');
