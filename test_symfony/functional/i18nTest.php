<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app = 'i18n';
if (!include(dirname(__FILE__).'/../bootstrap/functional.php'))
{
  return;
}

class myTestBrowser extends sfTestBrowser
{
  public function isUserCulture($culture)
  {
    $this->test->is($this->getContext()->getUser()->getCulture(), $culture, sprintf('user culture is "%s"', $culture));

    return $this;
  }
}

$b = new myTestBrowser();
$b->initialize();

// default culture (en)
$b->
  get('/')->
  isStatusCode(200)->
  isRequestParameter('module', 'i18n')->
  isRequestParameter('action', 'index')->
  isUserCulture('en')->
  checkResponseElement('#action', '/an english sentence/i')->
  checkResponseElement('#template', '/an english sentence/i')
;

$b->
  get('/fr/i18n/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'i18n')->
  isRequestParameter('action', 'index')->
  isUserCulture('fr')->

  // messages in the global directories
  checkResponseElement('#action', '/une phrase en français/i')->
  checkResponseElement('#template', '/une phrase en français/i')->

  // messages in the module directories
  checkResponseElement('#action_local', '/une phrase locale en français/i')->
  checkResponseElement('#template_local', '/une phrase locale en français/i')->

  // messages in another global catalogue
  checkResponseElement('#action_other', '/une autre phrase en français/i')->
  checkResponseElement('#template_other', '/une autre phrase en français/i')->

  // messages in another module catalogue
  checkResponseElement('#action_other_local', '/une autre phrase locale en français/i')->
  checkResponseElement('#template_other_local', '/une autre phrase locale en français/i')
;

// messages for a module plugin
$b->
  get('/fr/sfI18NPlugin/index')->
  isStatusCode(200)->
  isRequestParameter('module', 'sfI18NPlugin')->
  isRequestParameter('action', 'index')->
  isUserCulture('fr')->
  checkResponseElement('#action', '/une phrase en français/i')->
  checkResponseElement('#template', '/une phrase en français/i')->
  checkResponseElement('#action_local', '/une phrase locale en français/i')->
  checkResponseElement('#template_local', '/une phrase locale en français/i')
;

