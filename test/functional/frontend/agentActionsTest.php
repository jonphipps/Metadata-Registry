<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

$browser->post('/login', array(
  'nickname' => 'admin',
  'password' => 'admin',
  'password_bis' => '',
  'email' => '',
  'referer' => 'http%3A%2F%2Fregistry%2F',
  'commit' => 'sign+in' ))->
  isRedirected()->
  followRedirect();
//debugbreak();
$browser->
  get('/agent/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'agent')->
  isRequestParameter('action', 'list')->
  checkResponseElement('a[href$="/agent/create"]', true)
;
