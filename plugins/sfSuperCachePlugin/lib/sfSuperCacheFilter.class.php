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
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfSuperCacheFilter.class.php 3191 2007-01-08 11:03:25Z fabien $
 */
class sfSuperCacheFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    // execute next filter
    $filterChain->execute();

    $response = $this->getContext()->getResponse();

    // execute this filter only if cache is set and no GET or POST parameters
    // execute this filter not in debug mode, only if no_script_name and for 200 response code
    if (
      (!sfConfig::get('sf_cache') || count($_GET) || count($_POST))
      ||
      (sfConfig::get('sf_debug') || !sfConfig::get('sf_no_script_name') || $response->getStatusCode() != 200)
    )
    {
      return;
    }

    // only if cache is set for the entire page
    $cacheManager = $this->getContext()->getViewCacheManager();
    $uri = sfRouting::getInstance()->getCurrentInternalUri();
    if ($cacheManager->isCacheable($uri) && $cacheManager->withLayout($uri))
    {
      // save super cache
      $request = $this->getContext()->getRequest();
      $pathInfo = $request->getPathInfo();
      $file = sfConfig::get('sf_web_dir').'/'.$this->getParameter('cache_dir', 'cache').'/'.$request->getHost().('/' == $pathInfo[strlen($pathInfo) - 1] ? $pathInfo.'index.html' : $pathInfo);
      $current_umask = umask();
      umask(0000);
      $dir = dirname($file);
      if (!is_dir($dir))
      {
        mkdir($dir, 0777, true);
      }
      file_put_contents($file, $this->getContext()->getResponse()->getContent());
      chmod($file, 0666);
      umask($current_umask);
    }
  }
}
