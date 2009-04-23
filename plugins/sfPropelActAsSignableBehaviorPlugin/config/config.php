<?php
/*
 * This file is part of the sfPropelActAsSignableBehavior package.
 * 
 * (c) 2008 Nicolas Chambrier <naholyr@yahoo.fr>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

sfPropelBehavior::registerHooks('sfPropelActAsSignableBehavior', array (
  ':save:pre' => array ('sfPropelActAsSignableBehavior', 'preSave'),
  ':delete:pre' => array ('sfPropelActAsSignableBehavior', 'preDelete'),
));

sfPropelBehavior::registerHooks('signable', array (
  ':save:pre' => array ('sfPropelActAsSignableBehavior', 'preSave'),
  ':delete:pre' => array ('sfPropelActAsSignableBehavior', 'preDelete'),
));
