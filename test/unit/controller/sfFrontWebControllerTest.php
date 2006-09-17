<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$_test_dir = realpath(dirname(__FILE__).'/../..');
require_once($_test_dir.'/../lib/vendor/lime/lime.php');
require_once($_test_dir.'/unit/sfContextMock.class.php');
require_once($_test_dir.'/../lib/config/sfConfig.class.php');
require_once($_test_dir.'/../lib/controller/sfController.class.php');
require_once($_test_dir.'/../lib/controller/sfWebController.class.php');
require_once($_test_dir.'/../lib/controller/sfFrontWebController.class.php');
require_once($_test_dir.'/../lib/view/sfView.class.php');

$t = new lime_test(6, new lime_output_color());

sfConfig::set('sf_max_forwards', 10);
$context = new sfContext();
$controller = sfController::newInstance('sfFrontWebController');
$controller->initialize($context, null);

$tests = array(
  'module/action' => array(
    '',
    array(
      'module' => 'module',
      'action' => 'action',
    ),
  ),
  'module/action?id=12' => array(
    '',
    array(
      'module' => 'module',
      'action' => 'action',
      'id'     => 12,
    ),
  ),
  'module/action?id=12&test=4&toto=9' => array(
    '',
    array(
      'module' => 'module',
      'action' => 'action',
      'id'     => 12,
      'test'   => 4,
      'toto'   => 9,
    ),
  ),
  '@test?test=4' => array(
    'test',
    array(
      'test' => 4
    ),
  ),
  '@test' => array(
    'test',
    array(
    ),
  ),
  '@test?id=12&foo=bar' => array(
    'test',
    array(
      'id' => 12,
      'foo' => 'bar',
    ),
  ),
);

foreach ($tests as $url => $result)
{
  $t->is($controller->convertUrlStringToParameters($url), $result, '->convertUrlStringToParameters()');
}
