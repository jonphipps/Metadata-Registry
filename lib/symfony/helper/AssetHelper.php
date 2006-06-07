<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004 David Heinemeier Hansson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * AssetHelper.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     David Heinemeier Hansson
 * @version    SVN: $Id$
 */

/**
 * Returns a link tag that browsers and news readers can use to auto-detect a RSS or ATOM feed for this page. The type can
 * either be 'rss' (default) or 'atom'.
 *
 * Examples:
 *
 *   auto_discovery_link_tag('rss', 'module/feed') =>
 *     <link rel="alternate" type="application/rss+xml" title="RSS" href="http://www.curenthost.com/module/feed" />
 *
 *   auto_discovery_link_tag('rss', 'module/feed', array('title' => 'My RSS')) =>
 *     <link rel="alternate" type="application/rss+xml" title="My RSS" href="http://www.curenthost.com/module/feed" />
 */
function auto_discovery_link_tag($type = 'rss', $url_options = array(), $tag_options = array())
{
  return tag('link', array(
    'rel'   => isset($tag_options['rel']) ? $tag_options['rel'] : 'alternate',
    'type'  => isset($tag_options['type']) ? $tag_options['type'] : 'application/'.$type.'+xml',
    'title' => isset($tag_options['title']) ? $tag_options['title'] : ucfirst($type),
    'href'  => url_for($url_options, true)
  ));
}

/**
 *
 * Returns path to a javascript asset.
 *
 * Example:
 *
 *   javascript_path('ajax') =>
 *     /js/ajax.js
*/
function javascript_path($source, $absolute = false)
{
  return _compute_public_path($source, 'js', 'js', $absolute);
}

/**
 * Returns a script include tag per source given as argument.
 *
 * Examples:
 *
 *   javascript_include_tag('xmlhr') =>
 *     <script language="JavaScript" type="text/javascript" src="/js/xmlhr.js"></script>
 *
 *   javascript_include_tag('common.javascript', '/elsewhere/cools') =>
 *     <script language="JavaScript" type="text/javascript" src="/js/common.javascript"></script>
 *     <script language="JavaScript" type="text/javascript" src="/elsewhere/cools.js"></script>
 */
function javascript_include_tag()
{
  $html = '';
  foreach (func_get_args() as $source)
  {
    $source = javascript_path($source);
    $html .= content_tag('script', '', array('type' => 'text/javascript', 'src' => $source))."\n";
  }

  return $html;
}

/**
 * Returns path to a stylesheet asset.
 *
 * Example:
 *
 *   stylesheet_path('style') => /css/style.css
 */
function stylesheet_path($source, $absolute = false)
{
  return _compute_public_path($source, 'css', 'css', $absolute);
}

/**
 * Returns a css link tag per source given as argument.
 *
 * Examples:
 *
 *   stylesheet_link_tag('style') =>
 *     <link href="/stylesheets/style.css" media="screen" rel="stylesheet" type="text/css" />
 *
 *   stylesheet_link_tag('style', array('media' => 'all'))  =>
 *     <link href="/stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
 *
 *   stylesheet_link_tag('random.styles', '/css/stylish') =>
 *     <link href="/stylesheets/random.styles" media="screen" rel="stylesheet" type="text/css" />
 *     <link href="/css/stylish.css" media="screen" rel="stylesheet" type="text/css" />
 */
function stylesheet_tag()
{
  $sources = func_get_args();
  $sourceOptions = (func_num_args() > 1 && is_array($sources[func_num_args() - 1])) ? array_pop($sources) : array();

  $html = '';
  foreach ($sources as $source)
  {
    $source  = stylesheet_path($source);
    $options = array_merge(array('rel' => 'stylesheet', 'type' => 'text/css', 'media' => 'screen', 'href' => $source), $sourceOptions);
    $html   .= tag('link', $options)."\n";
  }

  return $html;
}

/**
 * Returns path to an image asset.
 *
 * Example:
 *
 * The src can be supplied as a...
 * * full path, like "/my_images/image.gif"
 * * file name, like "rss.gif", that gets expanded to "/images/rss.gif"
 * * file name without extension, like "logo", that gets expanded to "/images/logo.png"
 */
function image_path($source, $absolute = false)
{
  return _compute_public_path($source, 'images', 'png', $absolute);
}

/**
 * Returns an image tag converting the options instead html options on the tag, but with these special cases:
 *
 * * 'alt'  - If no alt text is given, the file name part of the +src+ is used (capitalized and without the extension)
 * * 'size' - Supplied as "XxY", so "30x45" becomes width="30" and height="45"
 *
 * The src can be supplied as a...
 * * full path, like "/my_images/image.gif"
 * * file name, like "rss.gif", that gets expanded to "/images/rss.gif"
 * * file name without extension, like "logo", that gets expanded to "/images/logo.png"
 */
function image_tag($source, $options = array())
{
  if (!$source)
  {
    return '';
  }

  $options = _parse_attributes($options);

  $absolute = false;
  if (isset($options['absolute']))
  {
    unset($options['absolute']);
    $absolute = true;
  }

  $options['src'] = image_path($source, $absolute);

  if (!isset($options['alt']))
  {
    $path_pos = strrpos($source, '/');
    $dot_pos = strrpos($source, '.');
    $begin = $path_pos ? $path_pos + 1 : 0;
    $nb_str = ($dot_pos ? $dot_pos : strlen($source)) - $begin;
    $options['alt'] = ucfirst(substr($source, $begin, $nb_str));
  }

  if (isset($options['size']))
  {
    list($options['width'], $options['height']) = split('x', $options['size'], 2);
    unset($options['size']);
  }

  return tag('img', $options);
}

function _compute_public_path($source, $dir, $ext, $absolute = false)
{
  if (strpos($source, '://'))
  {
    return $source;
  }

  $request = sfContext::getInstance()->getRequest();
  $sf_relative_url_root = $request->getRelativeUrlRoot();
  if (strpos($source, '/') !== 0)
  {
    $source = $sf_relative_url_root.'/'.$dir.'/'.$source;
  }
  if (strpos(basename($source), '.') === false)
  {
    $source .= '.'.$ext;
  }
  if ($sf_relative_url_root && strpos($source, $sf_relative_url_root) !== 0)
  {
    $source = $sf_relative_url_root.$source;
  }

  if ($absolute)
  {
    $source = 'http'.($request->isSecure() ? 's' : '').'://'.$request->getHost().$source;
  }

  return $source;
}

function include_metas()
{
  foreach (sfContext::getInstance()->getResponse()->getMetas() as $name => $content)
  {
    echo tag('meta', array('name' => $name, 'content' => $content))."\n";
  }
}

function include_http_metas()
{
  foreach (sfContext::getInstance()->getResponse()->getHttpMetas() as $httpequiv => $value)
  {
    echo tag('meta', array('http-equiv' => $httpequiv, 'content' => $value))."\n";
  }
}

function include_title()
{
  $title = sfContext::getInstance()->getResponse()->getTitle();

  echo content_tag('title', $title)."\n";
}

function include_javascripts()
{
  if (sfConfig::get('sf_logging_active')) sfContext::getInstance()->getLogger()->err('The function "include_javascripts()" is deprecated and not needed anymore.');
}

function include_stylesheets()
{
  if (sfConfig::get('sf_logging_active')) sfContext::getInstance()->getLogger()->err('The function "include_stylesheets()" is deprecated and not needed anymore.');
}

?>