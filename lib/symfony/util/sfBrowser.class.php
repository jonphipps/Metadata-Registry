<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfBrowser simulates a fake browser which can surf a symfony application.
 *
 * @package    symfony
 * @subpackage util
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfBrowser.class.php 2069 2006-09-13 21:10:46Z fabien $
 */
class sfBrowser
{
  protected
    $context       = null,
    $dom           = null,
    $stack         = array(),
    $stackPosition = -1,
    $cookieJar     = array();

  public function initialize ($hostname = null, $remote = null)
  {
    // setup our fake environment
    $_SERVER['HTTP_HOST'] = $hostname ? $hostname : sfConfig::get('sf_app').'-'.sfConfig::get('sf_environment');
    $_SERVER['HTTP_USER_AGENT'] = 'PHP5/CLI';
    $_SERVER['REMOTE_ADDR'] = $remote ? $remote : '127.0.0.1';

    sfConfig::set('sf_path_info_array', 'SERVER');
    sfConfig::set('sf_test', true);

    // we set a session id (fake cookie / persistence)
    $this->newSession();

    // register our shutdown function
    register_shutdown_function(array($this, 'shutdown'));
  }

  public function get($uri, $parameters = array())
  {
    return $this->call($uri, 'get', $parameters);
  }

  public function post($uri, $parameters = array())
  {
    return $this->call($uri, 'post', $parameters);
  }

  public function call($uri, $method = 'get', $parameters = array(), $changeStack = true)
  {
    $uri = $this->fixUri($uri);

    // add uri to the stack
    if ($changeStack)
    {
      $this->stack = array_slice($this->stack, 0, $this->stackPosition + 1);
      $this->stack[] = array(
        'uri'        => $uri,
        'method'     => $method,
        'parameters' => $parameters,
      );
      $this->stackPosition = count($this->stack) - 1;
    }

    list($path, $query_string) = false !== ($pos = strpos($uri, '?')) ? array(substr($uri, 0, $pos), substr($uri, $pos + 1)) : array($uri, '');
    $query_string = html_entity_decode($query_string);

    // remove anchor
    $path = preg_replace('/#.*/', '', $path);

    // prepare the request object
    unset($_SERVER['argv']);
    $_SERVER['REQUEST_METHOD']  = strtoupper($method);
    $_SERVER['PATH_INFO']       = $path;
    $_SERVER['REQUEST_URI']     = '/index.php'.$uri;
    $_SERVER['SCRIPT_NAME']     = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = '/index.php';
    $_SERVER['QUERY_STRING']    = $query_string;

    // request parameters
    $_GET = $_POST = array();
    if (strtoupper($method) == 'POST')
    {
      $_POST = $parameters;
    }
    if (strtoupper($method) == 'GET')
    {
      $_GET  = $parameters;
    }
    parse_str($query_string, $qs);
    if (is_array($qs))
    {
      $_GET = array_merge($qs, $_GET);
    }

    // restore cookies
    $_COOKIE = array();
    foreach ($this->cookieJar as $name => $cookie)
    {
      $_COOKIE[$name] = $cookie['value'];
    }

    // recycle our context object
    sfContext::removeInstance();
    $this->context = sfContext::getInstance();

    // launch request via controller
    $controller = $this->context->getController();
    $request    = $this->context->getRequest();

    // we register a fake rendering filter
    $controller->setRenderingFilterClassName('sfFakeRenderingFilter');

    // dispatch our request and ignore output
    ob_start();
    $controller->dispatch();
    $retval = ob_get_clean();

    // append retval to the response content
    $this->getResponse()->setContent($this->getResponse()->getContent().$retval);

    // manually shutdown user to save current session data
    $this->context->getUser()->shutdown();

    // save cookies
    $this->cookieJar = array();
    foreach ($this->getResponse()->getCookies() as $name => $cookie)
    {
      // FIXME: deal with expire, path, secure, ...
      $this->cookieJar[$name] = $cookie;
    }

    // for HTML/XML content, create a DOM and sfDomCssSelector objects for the response content
    if (preg_match('/(x|ht)ml/i', $this->getResponse()->getContentType()))
    {
      $this->dom = new DomDocument('1.0', sfConfig::get('sf_charset'));
      $this->dom->validateOnParse = true;
      @$this->dom->loadHTML($this->getResponse()->getContent());
      $this->domCssSelector = new sfDomCssSelector($this->dom);
    }

    return $this;
  }

  public function back()
  {
    if ($this->stackPosition < 1)
    {
      throw new sfException('You are already on the first page.');
    }

    --$this->stackPosition;
    return $this->call($this->stack[$this->stackPosition]['uri'], $this->stack[$this->stackPosition]['method'], $this->stack[$this->stackPosition]['parameters'], false);
  }

  public function forward()
  {
    if ($this->stackPosition > count($this->stack) - 2)
    {
      throw new sfException('You are already on the last page.');
    }

    ++$this->stackPosition;
    return $this->call($this->stack[$this->stackPosition]['uri'], $this->stack[$this->stackPosition]['method'], $this->stack[$this->stackPosition]['parameters'], false);
  }

  public function reload()
  {
    if (-1 == $this->stackPosition)
    {
      throw new sfException('No page to reload.');
    }

    return $this->call($this->stack[$this->stackPosition]['uri'], $this->stack[$this->stackPosition]['method'], $this->stack[$this->stackPosition]['parameters'], false);
  }

  public function getResponseDomCssSelector()
  {
    return $this->domCssSelector;
  }

  public function getResponseDom()
  {
    return $this->dom;
  }

  public function getContext()
  {
    return $this->context;
  }

  public function getResponse()
  {
    return $this->context->getResponse();
  }

  public function getRequest()
  {
    return $this->context->getRequest();
  }

  public function followRedirect()
  {
    $locations = $this->getContext()->getResponse()->getHttpHeader('location');

    return $this->get($locations[0]);
  }

  // link or button
  public function click($name, $arguments = array())
  {
    $xpath = new DomXpath($this->dom);
    $dom   = $this->dom;

    if ($link = $xpath->query('//a[.="'.$name.'"]')->item(0))
    {
      // link
      return $this->call($link->getAttribute('href'));
    }
    else
    {
      $forms = $xpath->query('//form');
      foreach ($forms as $form)
      {
        if ($button = $xpath->query('//input[(@type="submit" or @type="button") and @value="'.$name.'"]', $form)->item(0))
        {
          // button
          $url = $form->getAttribute('action');
          if ($form->getAttribute('method'))
          {
            $method = strtolower($form->getAttribute('method'));
          }
          else
          {
            $method = 'get';
          }

          // merge form default values and arguments
          $defaults = array();
          foreach($xpath->query('descendant::input | descendant::textarea | descendant::select', $form) as $element)
          {
            $name = $element->getAttribute('name');
            if ($element->nodeName == 'input')
            {
              $defaults[$name] = $element->getAttribute('value');
            }
            else if ($element->nodeName == 'textarea')
            {
              $defaults[$name] = '';
              foreach ($element->childNodes as $el)
              {
                $defaults[$name] .= $dom->saveXML($el);
              }
            }
            else if ($element->nodeName == 'select')
            {
              if ($multiple = $element->hasAttribute('multiple'))
              {
                $name = str_replace('[]', '', $name);
                $defaults[$name] = array();
              }
              else
              {
                $defaults[$name] = null;
              }
              foreach ($xpath->query('descendant::option', $element) as $option)
              {
                if ($option->getAttribute('selected'))
                {
                  if ($multiple)
                  {
                    $defaults[$name][] = $option->getAttribute('value');
                  }
                  else
                  {
                    $defaults[$name] = $option->getAttribute('value');
                  }
                }
              }
            }
          }

          // create query_string
          $arguments = array_merge($defaults, $arguments);
          $query_string = http_build_query($arguments);
          $sep = false === strpos($url, '?') ? '?' : '&';

          if ('post' === $method)
          {
            return $this->call($url, $method, $arguments);
          }
          else
          {
            return $this->call($url.($query_string ? $sep.$query_string : ''), $method);
          }
        }
      }
    }

    throw new sfException(sprintf('Cannot find the "%s" link or button.', $name));
  }

  public function restart()
  {
    $this->newSession();
    $this->cookieJar = array();
    $this->stack = array();
    $this->stackPosition = -1;

    return $this;
  }

  public function shutdown()
  {
    // we remove all session data
    sfToolkit::clearDirectory(sfConfig::get('sf_test_cache_dir').'/sessions');
  }

  protected function fixUri($uri)
  {
    // remove absolute information if needed (to be able to do follow redirects, click on links, ...)
    if (0 === strpos($uri, 'http'))
    {
      $uri = substr($uri, strpos($uri, 'index.php') + strlen('index.php'));
    }
    $uri = str_replace('/index.php', '', $uri);

    // # as a uri
    if ('#' == $uri[0])
    {
      $uri = $this->stack[$this->stackPosition]['uri'].$uri;
    }

    return $uri;
  }

  protected function newSession()
  {
    $_SERVER['session_id'] = md5(uniqid(rand(), true));
  }
}

class sfFakeRenderingFilter extends sfFilter
{
  public function execute ($filterChain)
  {
  }
}
