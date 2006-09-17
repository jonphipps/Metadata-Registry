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
require_once($_test_dir.'/../lib/config/sfConfig.class.php');

$t = new lime_test(6, new lime_output_color());

// ::get() ::set()
sfConfig::clear();

sfConfig::set('foo', 'bar');
$t->is(sfConfig::get('foo'), 'bar', '::get() returns the value of key config');
$t->is(sfConfig::get('foo1', 'default_value'), 'default_value', '::get() takes a default value as its second argument');

// ::add()
sfConfig::clear();

sfConfig::set('foo', 'bar');
sfConfig::set('foo1', 'foo1');
sfConfig::add(array('foo' => 'foo', 'bar' => 'bar'));

$t->is(sfConfig::get('foo'), 'foo', '::add() adds an array of config parameters');
$t->is(sfConfig::get('bar'), 'bar', '::add() adds an array of config parameters');
$t->is(sfConfig::get('foo1'), 'foo1', '::add() adds an array of config parameters');

// ::clear()
sfConfig::clear();
$t->is(sfConfig::get('foo1'), null, '::clear() removes all config parameters');
