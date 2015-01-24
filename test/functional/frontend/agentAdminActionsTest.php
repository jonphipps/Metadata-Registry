<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();



//$browser->
//  get('/agent/list');

//$loggedIn = (false !== strpos($browser->getResponse()->getContent(),'sign out'));
//$loggedInAsAdmin = (false !== strpos($browser->getResponse()->getContent(),'admin profile'));

//if logged in as another user, sign out and login
//if logged in as admin, skip login
//if ($loggedIn && !$loggedInAsAdmin)
//{
//  $browser->click('sign out');
//}

//if (!$loggedIn)
//{
  $browser->
    get('/login')->
    isStatusCode(200);

  $browser->post('/login', array(
    'nickname' => 'admin',
    'password' => 'admin',
    'password_bis' => '',
    'email' => '',
    'referer' => 'http%3A%2F%2Fregistry%2F',
    'commit' => 'sign+in' ))->
    isRedirected()->
    followRedirect();
//}

//should be on the main page now
//global head settings
$browser->
  get('/agent/list')->
  isStatusCode(200)->
  isRequestParameter('module', 'agent')->
  isRequestParameter('action', 'list')->
  checkResponseElement('meta[content="text/html; charset=utf-8"]', true)->
  checkResponseElement('meta[content="text/css"]', true)->
  checkResponseElement('meta[content="en"]', true)->
  checkResponseElement('meta[name="robots"]', true)->
  checkResponseElement('meta[content="index,follow"]', true)->
  checkResponseElement('meta[name="description"]', true)->
  checkResponseElement('meta[name="keywords"]', true)->
  checkResponseElement('meta[name="language"]', true)->
  checkResponseElement('meta[content="en"]', true)->
  checkResponseElement('link[rel="shortcut icon"]', true)
;

//dynamic head settings
$browser->
  checkResponseElement('script[src="/sf/prototype/js/prototype.js"]', true)->
  checkResponseElement('script[src="/sf/prototype/js/builder.js"]', true)->
  checkResponseElement('script[src="/sf/prototype/js/effects.js"]', true)->
  checkResponseElement('link[href="/jpAdminPlugin/css/main.css"]', true)->
  checkResponseElement('link[href="/css/main.css"]', true)->
  checkResponseElement('link[href="/css/layout.css"]', true)->
  checkResponseElement('link[href="/css/agent/layout.css"]', true)
;

//admin sidebar
$browser->
  checkResponseElement('div#content_bar > div#panel_admin > h2', '/administration/')
;

//list
$browser->
  checkResponseElement('head > title', '/Registry :: Owners/')->
  checkResponseElement('body', '/Owners/')->
  checkResponseElement('body', '/National Science Digital Library/')->
  checkResponseElement('ul.sf_admin_td_actions > li > a > img[title="edit"]', true)->
  checkResponseElement('ul.sf_admin_actions > li > input[value="Create"]', true)
;

//show
$browser->click('National Science Digital Library')->
  isStatusCode(200)->
  isRequestParameter('module', 'agent')->
  isRequestParameter('action', 'show')->
  isRequestParameter('id', '53')->
  checkResponseElement('#sf_fieldset_metadata', '/Metadata/')->
  checkResponseElement('#show_row_content_agent_id', '/53/')->
  checkResponseElement('#show_row_content_agent_created_at', '/13 April 2006 11:54/')->
  checkResponseElement('#show_row_agent_last_updated', '/14 September 2006 12:48/')->
  checkResponseElement('#sf_fieldset_detail', '/Detail/')->
  checkResponseElement('#show_row_agent_type', '/Organization/')->
  checkResponseElement('#show_row_content_agent_org_name', '/National Science Digital Library/')->
  checkResponseElement('#sf_admin_header h1', '/Detail for National Science Digital Library/')->
  checkResponseElement('input[title="Go back to the Owner list"]', true)->
  checkResponseElement('input[value="Edit"]', true)
;

//edit
$browser->get('/agent/edit/id/53')->
  isStatusCode(200)->
  isRequestParameter('module', 'agent')->
  isRequestParameter('action', 'edit')->
  isRequestParameter('id', '53')
;
