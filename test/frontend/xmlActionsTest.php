<?php

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

$browser->
  get('/xml/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'xml')->
  isRequestParameter('action', 'index')->
  checkResponseElement('body', '/xml/')
;
