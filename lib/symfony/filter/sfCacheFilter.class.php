<?php
/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage filter
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfCacheFilter extends sfFilter
{
  private
    $cacheManager = null,
    $request      = null,
    $response     = null,
    $cache       = array();

  public function initialize($context, $parameters = array())
  {
    parent::initialize($context, $parameters);

    $this->cacheManager = $context->getViewCacheManager();
    $this->request      = $context->getRequest();
    $this->response     = $context->getResponse();
  }

  /**
   * Execute this filter.
   *
   * @param FilterChain A FilterChain instance.
   *
   * @return void
   */
  public function execute ($filterChain)
  {
    // execute this filter only once, if cache is set and no GET or POST parameters
    if (!$this->isFirstCall() || !sfConfig::get('sf_cache') || count($_GET) || count($_POST))
    {
      $filterChain->execute();

      return;
    }

    // register our cache configuration
    $this->cacheManager->registerConfiguration($this->getContext()->getModuleName());

    $uri = sfRouting::getInstance()->getCurrentInternalUri();

    // page cache
    $this->cache[$uri] = array('page' => false, 'action' => false);
    $cacheable = $this->cacheManager->isCacheable($uri);
    if ($cacheable)
    {
      if ($this->cacheManager->withLayout($uri))
      {
        $inCache = $this->getPageCache($uri);
        $this->cache[$uri]['page'] = !$inCache;

        if ($inCache)
        {
          // page is in cache, so no need to run execution filter
          $filterChain->executionFilterDone();
        }
      }
      else
      {
        $inCache = $this->getActionCache($uri);
        $this->cache[$uri]['action'] = !$inCache;
      }
    }

    $filterChain->execute();
  }

  /**
   * Execute this filter.
   *
   * @param FilterChain A FilterChain instance.
   *
   * @return void
   */
  public function executeBeforeRendering ($filterChain)
  {
    // execute this filter only once, if cache is set and no GET or POST parameters
    if (!$this->isFirstCallBeforeRendering() || !sfConfig::get('sf_cache') || count($_GET) || count($_POST))
    {
      $filterChain->execute();

      return;
    }

    // cache only 200 HTTP status
    if ($this->response->getStatusCode() == 200)
    {
      $uri = sfRouting::getInstance()->getCurrentInternalUri();

      // save page in cache
      if ($this->cache[$uri]['page'])
      {
        // set some headers that deals with cache
        $lifetime = $this->cacheManager->getClientLifeTime($uri, 'page');
        $this->response->setHttpHeader('Last-Modified', $this->response->getDate(time()), false);
        $this->response->setHttpHeader('Expires', $this->response->getDate(time() + $lifetime), false);
        $this->response->addCacheControlHttpHeader('max-age', $lifetime);

        // set Vary headers
        foreach ($this->cacheManager->getVary($uri, 'page') as $vary)
        {
          $this->response->addVaryHttpHeader($vary);
        }

        $this->setPageCache($uri);
      }
      else if ($this->cache[$uri]['action'])
      {
        // save action in cache
        $this->setActionCache($uri);
      }
    }

    // remove PHP automatic Cache-Control and Expires headers if not overwritten by application or cache
    if ($this->response->hasHttpHeader('Last-Modified') || sfConfig::get('sf_etag'))
    {
      $this->response->setHttpHeader('Cache-Control', null, false);
      $this->response->setHttpHeader('Expires', null, false);
      $this->response->setHttpHeader('Pragma', null, false);
    }

    // Etag support
    if (sfConfig::get('sf_etag'))
    {
      $etag = md5($this->response->getContent());
      $this->response->setHttpHeader('ETag', $etag);

      if ($this->request->getHttpHeader('IF_NONE_MATCH') == $etag)
      {
        $this->response->setStatusCode(304);
        $this->response->setContent('');

        if (sfConfig::get('sf_logging_active'))
        {
          $this->getContext()->getLogger()->info('{sfCacheFilter} ETag matches If-None-Match (send 304)');
        }
      }
    }

    // conditional GET support
    // never in debug mode
    if ($this->response->hasHttpHeader('Last-Modified') && !sfConfig::get('sf_debug'))
    {
      $last_modified = $this->response->getHttpHeader('Last-Modified');
      $last_modified = $last_modified[0];
      if ($this->request->getHttpHeader('IF_MODIFIED_SINCE') == $last_modified)
      {
        $this->response->setStatusCode(304);
        $this->response->setContent('');

        if (sfConfig::get('sf_logging_active'))
        {
          $this->getContext()->getLogger()->info('{sfCacheFilter} Last-Modified matches If-Modified-Since (send 304)');
        }
      }
    }

    // execute next filter
    $filterChain->execute();
  }

  private function setPageCache($uri)
  {
    if ($this->getContext()->getController()->getRenderMode() != sfView::RENDER_CLIENT)
    {
      return;
    }

    // save content in cache
    $this->cacheManager->set(serialize($this->response), $uri);

    if (sfConfig::get('sf_web_debug'))
    {
      $content = sfWebDebug::getInstance()->decorateContentWithDebug($uri, $this->response->getContent(), true);
      $this->response->setContent($content);
    }
  }

  private function getPageCache($uri)
  {
    $context = $this->getContext();

    // get the current action information
    $moduleName = $context->getModuleName();
    $actionName = $context->getActionName();

    $retval = $this->cacheManager->get($uri);

    if ($retval === null)
    {
      return false;
    }

    $cachedResponse = unserialize($retval);
    $cachedResponse->setContext($context);

    $controller = $context->getController();
    if ($controller->getRenderMode() == sfView::RENDER_VAR)
    {
      $controller->getActionStack()->getLastEntry()->setPresentation($cachedResponse->getContent());
      $this->response->setContent('');
    }
    else
    {
      $context->setResponse($cachedResponse);
      $this->response = $this->getContext()->getResponse();

      if (sfConfig::get('sf_web_debug'))
      {
        $content = sfWebDebug::getInstance()->decorateContentWithDebug($uri, $this->response->getContent(), false);
        $this->response->setContent($content);
      }
    }

    return true;
  }

  private function setActionCache($uri)
  {
    $content = $this->response->getParameter($uri.'_action', null, 'symfony/cache');

    if ($content !== null)
    {
      $this->cacheManager->set($content, $uri);
    }
  }

  private function getActionCache($uri)
  {
    // retrieve content from cache
    $retval = $this->cacheManager->get($uri);

    if (sfConfig::get('sf_web_debug'))
    {
      $tmp = unserialize($retval);
      $tmp['content'] = sfWebDebug::getInstance()->decorateContentWithDebug($uri, $tmp['content'], false);
      $retval = serialize($tmp);
    }

    $this->response->setParameter('current_key', $uri.'_action', 'symfony/cache/current');
    $this->response->setParameter($uri.'_action', $retval, 'symfony/cache');

    return ($retval ? true : false);
  }
}
