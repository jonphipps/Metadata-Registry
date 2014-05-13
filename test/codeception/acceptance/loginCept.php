<?php
  $I = new WebDev\loginSteps($scenario);
  $I->wantTo('login as an admin');
  $I->amOnPage('/');
  $I->loginAs("admin","admin");
  $I->click("admin profile");
  $I->see("admin","div.content");
  $I->canSeeInDatabase("reg_user",array("nickname"=>"admin","last_name"=>null, "first_name"=>null));
  $I->fillField("first_name","Joe");
  $I->fillField("#last_name","Admin");
  $I->click("update it");
  //$I->canSee("Joe","#first_name");
  //$I->canSee("Admin","#last_name");
  $I->canSee("Joe Admin's profile","h1");
  $I->seeInDatabase("reg_user",array("nickname"=>"admin","last_name"=>"Admin", "first_name"=>"Joe"));
