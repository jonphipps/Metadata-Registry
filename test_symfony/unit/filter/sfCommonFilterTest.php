<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../../bootstrap/unit.php');

$t = new lime_test(32, new lime_output_color());

class sfContext
{
  public $response = null;
  public $request = null;
  static public $instance = null;

  public static function getInstance()
  {
    if (!isset(self::$instance))
    {
      self::$instance = new sfContext();
    }

    return self::$instance;
  }

  public function getRequest()
  {
    return $this->request;
  }

  public function getResponse()
  {
    return $this->response;
  }
}

class myRequest
{
  public function getRelativeUrlRoot()
  {
    return '';
  }

  public function getMethodName()
  {
    return 'GET';
  }
}

class firstTestFilter extends sfFilter
{
  public $response = null;

  public function execute($filterChain)
  {
    $response = $this->response;

    // sfCommonFilter has executed code before its call to filterChain->execute()

    $filterChain->execute();

    // action execution
    $response->setContent('<html><head></head></html>');
  }
}

class lastTestFilter extends sfFilter
{
  public $response = null;

  public function execute($filterChain)
  {
    $response = $this->response;

    // sfCommonFilter has executed no code
    $response->addJavascript('last1', 'last');
    $response->addJavascript('first1', 'first');
    $response->addJavascript('middle');
    $response->addJavascript('last2', 'last');
    $response->addJavascript('multiple');
    $response->addJavascript('multiple');
    $response->addJavascript('first2', 'first');
    $response->addJavascript('multiple', 'last');

    $response->addStylesheet('last1', 'last');
    $response->addStylesheet('first1', 'first');
    $response->addStylesheet('middle');
    $response->addStylesheet('last2', 'last');
    $response->addStylesheet('multiple');
    $response->addStylesheet('multiple');
    $response->addStylesheet('first2', 'first');
    $response->addStylesheet('multiple', 'last');

    $filterChain->execute();

    // sfCommmonFilter has executed all its code
  }
}

$context = sfContext::getInstance();
$context->request = new myRequest();
$response = new sfWebResponse();
$response->initialize($context);
$context->response = $response;

$selector = execute_filter_chain($context, $t);

check_javascripts_included($t, $selector);
check_stylesheets_included($t, $selector);

// test disabling javascript and stylesheet automatic inclusion

$response->setParameter('stylesheets_included', true, 'symfony/view/asset');
$response->setParameter('javascripts_included', true, 'symfony/view/asset');
$selector = execute_filter_chain($context, $t);
$t->is($selector->getElements('head script'), array(), '->execute() does not add javascripts if you used get_javascripts() helper');
$t->is($selector->getElements('head link'), array(), '->execute() does not add stylesheets if you used get_stylesheets() helper');

$response->setParameter('stylesheets_included', true, 'symfony/view/asset');
$response->setParameter('javascripts_included', false, 'symfony/view/asset');
$selector = execute_filter_chain($context, $t);
check_javascripts_included($t, $selector);
$t->is($selector->getElements('head link'), array(), '->execute() does not add javascripts if you used get_javascripts() helper');

$response->setParameter('stylesheets_included', false, 'symfony/view/asset');
$response->setParameter('javascripts_included', true, 'symfony/view/asset');
$selector = execute_filter_chain($context, $t);
$t->is($selector->getElements('head script'), array(), '->execute() does not add javascripts if you used get_javascripts() helper');
check_stylesheets_included($t, $selector);

function check_stylesheets_included($t, $selector)
{
  $stylesheets = $selector->getElements('head link');
  $t->is(count($stylesheets), 6, '->execute() adds 6 stylesheets');
  $t->is($stylesheets[0]->getAttribute('href'), '/css/first1.css', '->execute() adds stylesheets with position "first" at the beginning');
  $t->is($stylesheets[1]->getAttribute('href'), '/css/first2.css', '->execute() adds stylesheets with same position in their registration order');
  $t->is($stylesheets[2]->getAttribute('href'), '/css/middle.css', '->execute() adds stylesheets with no position after "first" ones and before "lasts" one');
  $t->is($stylesheets[3]->getAttribute('href'), '/css/multiple.css', '->execute() adds a stylesheet only once');
  $t->is($stylesheets[4]->getAttribute('href'), '/css/last1.css', '->execute() adds stylesheets with position "last" at the end');
  $t->is($stylesheets[5]->getAttribute('href'), '/css/last2.css', '->execute() adds stylesheets with same position in their registration order');
}

function check_javascripts_included($t, $selector)
{
  $scripts = $selector->getElements('head script');
  $t->is(count($scripts), 6, '->execute() adds 6 javascripts');
  $t->is($scripts[0]->getAttribute('src'), '/js/first1.js', '->execute() adds javascripts with position "first" at the beginning');
  $t->is($scripts[1]->getAttribute('src'), '/js/first2.js', '->execute() adds javascripts with same position in their registration order');
  $t->is($scripts[2]->getAttribute('src'), '/js/middle.js', '->execute() adds javascripts with no position after "first" ones and before "lasts" one');
  $t->is($scripts[3]->getAttribute('src'), '/js/multiple.js', '->execute() adds a javascript only once');
  $t->is($scripts[4]->getAttribute('src'), '/js/last1.js', '->execute() adds javascripts with position "last" at the end');
  $t->is($scripts[5]->getAttribute('src'), '/js/last2.js', '->execute() adds javascripts with same position in their registration order');
}

function execute_filter_chain($context, $t)
{
  $filterChain = new sfFilterChain();

  $filter = new lastTestFilter();
  $filter->response = $context->response;
  $filter->initialize($context);
  $filterChain->register($filter);

  $filter = new sfCommonFilter();
  $filter->initialize($context);
  $filterChain->register($filter);

  $filter = new firstTestFilter();
  $filter->response = $context->response;
  $filter->initialize($context);
  $filterChain->register($filter);

  $filterChain->execute();

  $dom = new DomDocument('1.0', 'UTF-8');
  $dom->validateOnParse = true;
  $dom->loadHTML($context->response->getContent());
  $selector = new sfDomCssSelector($dom);

  return $selector;
}
