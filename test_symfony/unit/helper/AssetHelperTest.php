<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../../bootstrap/unit.php');

sfLoader::loadHelpers(array('Helper', 'Tag', 'Url', 'Asset'));

$t = new lime_test(37, new lime_output_color());

class myRequest
{
  public $relativeUrlRoot = '';

  public function getRelativeUrlRoot()
  {
    return $this->relativeUrlRoot;
  }

  public function isSecure()
  {
    return false;
  }

  public function getHost()
  {
    return 'localhost';
  }
}

class sfContext
{
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
}

$context = sfContext::getInstance();
$request = new myRequest();
$context->request = $request;

// _compute_public_path()
$t->diag('_compute_public_path');
$t->is(_compute_public_path('foo', 'css', 'css'), '/css/foo.css', '_compute_public_path() converts a string to a web path');
$t->is(_compute_public_path('foo', 'css', 'css', true), 'http://localhost/css/foo.css', '_compute_public_path() can create absolute links');
$t->is(_compute_public_path('foo.css2', 'css', 'css'), '/css/foo.css2', '_compute_public_path() does not add suffix if one already exists');
$request->relativeUrlRoot = '/bar';
$t->is(_compute_public_path('foo', 'css', 'css'), '/bar/css/foo.css', '_compute_public_path() takes into account the relative url root configuration');
$request->relativeUrlRoot = '';
$t->is(_compute_public_path('foo.css?foo=bar', 'css', 'css'), '/css/foo.css?foo=bar', '_compute_public_path() takes into account query strings');
$t->is(_compute_public_path('foo?foo=bar', 'css', 'css'), '/css/foo.css?foo=bar', '_compute_public_path() takes into account query strings');

// image_tag()
$t->diag('image_tag()');
$t->is(image_tag(''), '', 'image_tag() returns nothing when called without arguments');
$t->is(image_tag('test'), '<img src="/images/test.png" alt="Test" />', 'image_tag() takes an image name as its first argument');
$t->is(image_tag('test.png'), '<img src="/images/test.png" alt="Test" />', 'image_tag() can take an image name with an extension');
$t->is(image_tag('/images/test.png'), '<img src="/images/test.png" alt="Test" />', 'image_tag() can take an absolute image path');
$t->is(image_tag('/images/test'), '<img src="/images/test.png" alt="Test" />', 'image_tag() can take an absolute image path without extension');
$t->is(image_tag('test.jpg'), '<img src="/images/test.jpg" alt="Test" />', 'image_tag() can take an image name with an extension');
$t->is(image_tag('test', array('alt' => 'Foo')), '<img alt="Foo" src="/images/test.png" />', 'image_tag() takes an array of options as its second argument to override alt');
$t->is(image_tag('test', array('size' => '10x10')), '<img src="/images/test.png" alt="Test" height="10" width="10" />', 'image_tag() takes a size option');
$t->is(image_tag('test', array('absolute' => true)), '<img src="http://localhost/images/test.png" alt="Test" />', 'image_tag() can take an absolute parameter');
$t->is(image_tag('test', array('class' => 'bar')), '<img class="bar" src="/images/test.png" alt="Test" />', 'image_tag() takes whatever option you want');

// stylesheet_tag()
$t->diag('stylesheet_tag()');
$t->is(stylesheet_tag('style'), 
  '<link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />'."\n", 
  'stylesheet_tag() takes a stylesheet name as its first argument');
$t->is(stylesheet_tag('random.styles', '/css/stylish'),
  '<link rel="stylesheet" type="text/css" media="screen" href="/css/random.styles" />'."\n".
  '<link rel="stylesheet" type="text/css" media="screen" href="/css/stylish.css" />'."\n", 
  'stylesheet_tag() can takes n stylesheet names as its arguments');
$t->is(stylesheet_tag('style', array('media' => 'all')), 
  '<link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />'."\n", 
  'stylesheet_tag() can take a media option');
$t->is(stylesheet_tag('style', array('absolute' => true)), 
  '<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/css/style.css" />'."\n", 
  'stylesheet_tag() can take an absolute option to output an absolute file name');
$t->is(stylesheet_tag('style', array('raw_name' => true)), 
  '<link rel="stylesheet" type="text/css" media="screen" href="style" />'."\n", 
  'stylesheet_tag() can take a raw_name option to bypass file name decoration');

// javascript_include_tag()
$t->diag('javascript_include_tag()');
$t->is(javascript_include_tag('xmlhr'),
  '<script type="text/javascript" src="/js/xmlhr.js"></script>'."\n", 
  'javascript_include_tag() takes a javascript name as its first argument');
$t->is(javascript_include_tag('common.javascript', '/elsewhere/cools'),
  '<script type="text/javascript" src="/js/common.javascript"></script>'."\n".
  '<script type="text/javascript" src="/elsewhere/cools.js"></script>'."\n",
  'javascript_include_tag() can takes n javascript file names as its arguments');
$t->is(javascript_include_tag('xmlhr', array('absolute' => true)),
  '<script type="text/javascript" src="http://localhost/js/xmlhr.js"></script>'."\n", 
  'javascript_include_tag() can take an absolute option to output an absolute file name');
$t->is(javascript_include_tag('xmlhr', array('raw_name' => true)),
  '<script type="text/javascript" src="xmlhr"></script>'."\n", 
  'javascript_include_tag() can take a raw_name option to bypass file name decoration');

// javascript_path()
$t->diag('javascript_path()');
$t->is(javascript_path('xmlhr'), '/js/xmlhr.js', 'javascript_path() decorates a relative filename with js dir name and extension');
$t->is(javascript_path('/xmlhr'), '/xmlhr.js', 'javascript_path() does not decorate absolute file names with js dir name');
$t->is(javascript_path('xmlhr.foo'), '/js/xmlhr.foo', 'javascript_path() does not decorate file names with extension with .js');
$t->is(javascript_path('xmlhr.foo', true), 'http://localhost/js/xmlhr.foo', 'javascript_path() accepts a second parameter to output an absolute resource path');

// stylesheet_path()
$t->diag('stylesheet_path()');
$t->is(stylesheet_path('style'), '/css/style.css', 'stylesheet_path() decorates a relative filename with css dir name and extension');
$t->is(stylesheet_path('/style'), '/style.css', 'stylesheet_path() does not decorate absolute file names with css dir name');
$t->is(stylesheet_path('style.foo'), '/css/style.foo', 'stylesheet_path() does not decorate file names with extension with .css');
$t->is(stylesheet_path('style.foo', true), 'http://localhost/css/style.foo', 'stylesheet_path() accepts a second parameter to output an absolute resource path');

// image_path()
$t->diag('image_path()');
$t->is(image_path('img'), '/images/img.png', 'image_path() decorates a relative filename with images dir name and png extension');
$t->is(image_path('/img'), '/img.png', 'image_path() does not decorate absolute file names with images dir name');
$t->is(image_path('img.jpg'), '/images/img.jpg', 'image_path() does not decorate file names with extension with .png');
$t->is(image_path('img.jpg', true), 'http://localhost/images/img.jpg', 'image_path() accepts a second parameter to output an absolute resource path');

/*

// auto_discovery_link_tag()
$t->is(auto_discovery_link_tag(),
  '<link href="http://www.example.com" rel="alternate" title="RSS" type="application/rss+xml" />');

$t->is(auto_discovery_link_tag('atom'),
  '<link href="http://www.example.com" rel="alternate" title="ATOM" type="application/atom+xml" />');

$t->is(auto_discovery_link_tag('rss', array('action' => 'feed')),
  '<link href="http://www.example.com" rel="alternate" title="RSS" type="application/rss+xml" />');

$request = new sfWebRequest();
sfConfig::set('test_sfWebRequest_relative_url_root', '/mypath');
$context = new sfContext();

// auto_discovery()
$t->is(auto_discovery_link_tag('rss', array('action' => 'feed')),
  '<link href="http://www.example.com/mypath" rel="alternate" title="RSS" type="application/rss+xml" />');

$t->is(auto_discovery_link_tag('atom'),
  '<link href="http://www.example.com/mypath" rel="alternate" title="ATOM" type="application/atom+xml" />');

$t->is(auto_discovery_link_tag(),
  '<link href="http://www.example.com/mypath" rel="alternate" title="RSS" type="application/rss+xml" />');

*/