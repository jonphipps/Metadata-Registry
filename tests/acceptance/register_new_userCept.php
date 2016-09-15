<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('register a new user');
$I->amOnPage('/');
$I->click('register');
$I->seeInCurrentUrl('login');
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
$I->seeLink('Add Agent');
$I->dontSeeLink('Add Vocabulary' );
$I->dontSeeLink('Add Element Set');
$I->seeLink('vocab_admin profile');
$I->seeInTitle("The Registry! :: vocab_admin :: Home");
