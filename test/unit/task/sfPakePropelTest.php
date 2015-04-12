<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please component the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../../bootstrap/unit.php');
require_once($sf_symfony_lib_dir.'/vendor/pake/pakeFunction.php');
require_once($sf_symfony_lib_dir.'/vendor/pake/pakeGetopt.class.php');
require_once($sf_symfony_data_dir.'/tasks/sfPakePropel.php');

$t = new lime_test(52, new lime_output_color());

$fixture_dir = 'C:'.DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'registry'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'fixtures';

$t->diag("args == null -- can't be tested because pake catches the thrown exception");
$t->diag("args == foobar -- can't be tested because pake catches the thrown exception");
//try
//{
//  $args = _parse_args(array());
//  $t->fail('throws an exception if no application is provided');
//}
//catch (sfException $e)
//{
//  $t->pass('throws an exception if no application is provided');
//}
$testArray = array(
   'app'           => '',
   'env'           => 'dev',
   'delete'        => true,
   'dirs_or_files' => array()
   );

$args = 'frontend';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => true,
   'dirs_or_files' => array(0 => $fixture_dir)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);

$args = 'frontend test';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'test',
   'delete'        => true,
   'dirs_or_files' => array(0 => $fixture_dir)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'test',
   'delete'        => true,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR)
   );
checkTestArray(explode(" ", $args), $testArray, 'dump', $t);

$args = 'frontend test_data.yml';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => true,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR.'test_data.yml',)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => true,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR.'test_data.yml')
   );
checkTestArray(explode(" ", $args), $testArray, 'dump', $t);

$args = 'frontend test_data.yml append';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR.'test_data.yml',)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR.'test_data.yml')
   );
checkTestArray(explode(" ", $args), $testArray, 'dump', $t);

$args = 'frontend test test_data.yml append';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'test',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR.'test_data.yml',)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'test',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR)
   );
checkTestArray(explode(" ", $args), $testArray, 'dump', $t);

$args = 'frontend test append';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'test',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir,)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'test',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR)
   );
checkTestArray(explode(" ", $args), $testArray, 'dump', $t);

$args = 'frontend append';
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir,)
   );
checkTestArray(explode(" ", $args), $testArray, 'load', $t);
$testArray = array(
   'app'           => 'frontend',
   'env'           => 'dev',
   'delete'        => false,
   'dirs_or_files' => array(0 => $fixture_dir.DIRECTORY_SEPARATOR)
   );
checkTestArray(explode(" ", $args), $testArray, 'dump', $t);

function checkTestArray($args, $testArray, $task, $t)
{
  $t->diag($task.' - args == '. implode(" ", $args));
  $args = _parse_args($args, $task);
  foreach ($args as $key => $value)
  {
    //if (is_array($args[$key]));
    $t->is($args[$key], $testArray[$key], $args[$key]." == '".$testArray[$key]."'");
  }
}
