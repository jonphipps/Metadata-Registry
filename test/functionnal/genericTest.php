<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

include(dirname(__FILE__).'/bootstrap.php');

// default main page
$b->
  get('/')->
  isStatusCode(200)->
  isRequestParameter('module', 'default')->
  isRequestParameter('action', 'index')->
  checkResponseElement('body', '/congratulations/i')
;

// default 404
$b->
  get('/nonexistant')->
  isStatusCode(404)->
  checkResponseElement('body', '!/congratulations/i')
;

// available
sfConfig::set('sf_available', false);
$b->
  get('/')->
  isStatusCode(200)->
  checkResponseElement('body', '/unavailable/i')->
  checkResponseElement('body', '!/congratulations/i')
;
sfConfig::set('sf_available', true);

// module.yml: enabled
$b->
  get('/configModuleDisabled')->
  isStatusCode(200)->
  checkResponseElement('body', '/module is unavailable/i')->
  checkResponseElement('body', '!/congratulations/i')
;

// view.yml: has_layout
$b->
  get('/configViewHasLayout/withoutLayout')->
  isStatusCode(200)->
  checkResponseElement('body', '/no layout/i')->
  checkResponseElement('head title', false)
;

// security.yml: is_secure
$b->
  get('/configSecurityIsSecure')->
  isStatusCode(200)->
  checkResponseElement('body', '/You must enter your credentials to access this page/i')
;

// settings.yml: max_forwards
$b->
  get('/configSettingsMaxForwards/selfForward')->
  isStatusCode(200)->
  checkResponseElement('body', '/Too many forwards have been detected for this request/i')
;

// filters.yml: add a filter
$b->
  get('/configFiltersSimpleFilter')->
  isStatusCode(200)->
  checkResponseElement('p', '/in a filter/i')->
  checkResponseElement('body', '!/congratulation/i')
;
