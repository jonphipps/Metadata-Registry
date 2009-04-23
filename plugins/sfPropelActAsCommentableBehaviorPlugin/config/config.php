<?php
/*
 * This file is part of the sfPropelActAsCommentableBehavior package.
 *
 * (c) 2007-2009 Xavier Lacot <xavier@lacot.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// add routing rules
if (sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_use_routes', true) && in_array('sfComment', sfConfig::get('sf_enabled_modules', array())))
{
  $this->dispatcher->connect('routing.load_configuration', array('sfPropelActAsCommentableBehaviorRouting', 'listenToRoutingLoadConfigurationEvent'));
}

if (in_array('sfCommentAdmin', sfConfig::get('sf_enabled_modules')))
{
  $this->dispatcher->connect('routing.load_configuration', array('sfPropelActAsCommentableBehaviorRouting', 'addRouteForAdmin'));
}

// register behavior
sfPropelBehavior::registerMethods('sfPropelActAsCommentableBehavior', array (
  array (
    'sfPropelActAsCommentableBehavior',
    'addComment'
  ),
  array (
    'sfPropelActAsCommentableBehavior',
    'clearComments'
  ),
  array (
    'sfPropelActAsCommentableBehavior',
    'getComments'
  ),
  array (
    'sfPropelActAsCommentableBehavior',
    'getNbComments'
  ),
  array (
    'sfPropelActAsCommentableBehavior',
    'removeComment'
  )
));