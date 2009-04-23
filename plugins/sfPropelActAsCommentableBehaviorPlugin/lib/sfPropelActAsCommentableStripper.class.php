<?php
/*
 * This file is part of the sfPropelActAsCommentableBehavior package.
 *
 * (c) 2007-2009 Xavier Lacot <xavier@lacot.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfPropelActAsCommentableBehavior stripper class
 *
 * @author   Xavier Lacot
 * @see      http://www.symfony-project.org/plugins/sfPropelActAsCommentableBehaviorPlugin
 */
class sfPropelActAsCommentableStripper
{
  static public function clean($text)
  {
    $allowed_html_tags = sfConfig::get('app_sfPropelActAsCommentableBehaviorPlugin_allowed_tags', array());
    spl_autoload_register(array('HTMLPurifier_Bootstrap', 'autoload'));
    $config = HTMLPurifier_Config::createDefault();
    $config->set('HTML', 'Doctype', 'XHTML 1.0 Strict');
    $config->set('HTML', 'Allowed', implode(',', array_keys($allowed_html_tags)));

    if (isset($allowed_html_tags['a']))
    {
      $config->set('HTML', 'AllowedAttributes', 'a.href');
      $config->set('AutoFormat', 'Linkify', true);
    }

    if (isset($allowed_html_tags['p']))
    {
      $config->set('AutoFormat', 'AutoParagraph', true);
    }

    $purifier = new HTMLPurifier($config);
    return str_replace('<a href', '<a rel="nofollow" href', $purifier->purify($text));
  }
}