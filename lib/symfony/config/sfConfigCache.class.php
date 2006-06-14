<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfConfigCache allows you to customize the format of a configuration file to
 * make it easy-to-use, yet still provide a PHP formatted result for direct
 * inclusion into your modules.
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <skerr@mojavi.org>
 * @version    SVN: $Id$
 */
class sfConfigCache
{
  private
    $handlers = array();

  private static
    $instance = null;

  public static function getInstance()
  {
    if (!self::$instance)
    {
      self::$instance = new sfConfigCache();
    }

    return self::$instance;
  }

  /**
   * Load a configuration handler.
   *
   * @param string The handler to use when parsing a configuration file.
   * @param array  An array of absolute filesystem paths to configuration files.
   * @param string An absolute filesystem path to the cache file that will be written.
   *
   * @return void
   *
   * @throws <b>sfConfigurationException</b> If a requested configuration file
   *                                       does not have an associated configuration handler.
   */
  private function callHandler($handler, $configs, $cache)
  {
    if (count($this->handlers) == 0)
    {
      // we need to load the handlers first
      $this->loadConfigHandlers();
    }

    // handler to call for this configuration file
    $handlerToCall = null;

    // grab the base name of the handler
    $basename = basename($handler);
    if (isset($this->handlers[$handler]))
    {
      // we have a handler associated with the full configuration path
      $handlerToCall = $this->handlers[$handler];
    }
    else if (isset($this->handlers[$basename]))
    {
      // we have a handler associated with the configuration base name
      $handlerToCall = $this->handlers[$basename];
    }
    else
    {
      // let's see if we have any wildcard handlers registered that match
      // this basename
      foreach ($this->handlers as $key => $handlerInstance)
      {
        // replace wildcard chars in the configuration
        $pattern = strtr($key, array('.' => '\.', '*' => '.*?'));

        // create pattern from config
        if (preg_match('#'.$pattern.'#', $handler))
        {
          // we found a match!
          $handlerToCall = $this->handlers[$key];

          break;
        }
      }
    }

    if ($handlerToCall)
    {
      // call the handler and retrieve the cache data
      $data = $handlerToCall->execute($configs);

      $this->writeCacheFile($handler, $cache, $data);
    }
    else
    {
      // we do not have a registered handler for this file
      $error = sprintf('Configuration file "%s" does not have a registered handler', $config);

      throw new sfConfigurationException($error);
    }
  }

  public function findConfigPaths($configPath)
  {
    $configs = array();

    $globalConfigPath = basename(dirname($configPath)).'/'.basename($configPath);
    $files = array(
      sfConfig::get('sf_symfony_data_dir').'/'.$globalConfigPath, // default symfony configuration
      sfConfig::get('sf_app_dir').'/'.$globalConfigPath,          // default project configuration
      sfConfig::get('sf_plugin_data_dir').'/'.$configPath,        // used for plugin modules
      sfConfig::get('sf_symfony_data_dir').'/'.$configPath,       // core modules or global plugins
      sfConfig::get('sf_root_dir').'/'.$globalConfigPath,         // used for main configuration
      sfConfig::get('sf_cache_dir').'/'.$configPath,              // used for generated modules
      sfConfig::get('sf_app_dir').'/'.$configPath,
    );

    foreach ($files as $file)
    {
      if (is_readable($file))
      {
        $configs[] = $file;
      }
    }

    return $configs;
  }

  /**
   * Check to see if a configuration file has been modified and if so
   * recompile the cache file associated with it.
   *
   * If the configuration file path is relative, the path itself is relative
   * to the symfony [sf_app_dir] application setting.
   *
   * @param string A filesystem path to a configuration file.
   *
   * @return string An absolute filesystem path to the cache filename associated with this specified configuration file.
   *
   * @throws <b>sfConfigurationException</b> If a requested configuration file does not exist.
   */
  public function checkConfig($configPath, $optional = false)
  {
    // the cache filename we'll be using
    $cache = $this->getCacheName($configPath);

    if (sfConfig::get('sf_in_bootstrap') && is_readable($cache))
    {
      return $cache;
    }

    if (!sfToolkit::isPathAbsolute($configPath))
    {
      $files = $this->findConfigPaths($configPath);
    }
    else
    {
      $files = is_readable($configPath) ? array($configPath) : array();
    }

    if (!isset($files[0]))
    {
      if ($optional)
      {
        return null;
      }

      // configuration does not exist
      $error = sprintf('Configuration "%s" does not exist or is unreadable', $configPath);

      throw new sfConfigurationException($error);
    }

    // find the more recent configuration file last modification time
    $mtime = 0;
    foreach ($files as $file)
    {
      if (filemtime($file) > $mtime)
      {
        $mtime = filemtime($file);
      }
    }

    if (!is_readable($cache) || $mtime > filemtime($cache))
    {
      // configuration has changed so we need to reparse it
      $this->callHandler($configPath, $files, $cache);
    }

    return $cache;
  }

  /**
   * Clear all configuration cache files.
   *
   * @return void
   */
  public function clear()
  {
    sfToolkit::clearDirectory(sfConfig::get('sf_config_cache_dir'));
  }

  /**
   * Convert a normal filename into a cache filename.
   *
   * @param string A normal filename.
   *
   * @return string An absolute filesystem path to a cache filename.
   */
  public function getCacheName($config)
  {
    if (strlen($config) > 3 && ctype_alpha($config[0]) && $config[1] == ':' && ($config[2] == '\\' || $config[2] == '/'))
    {
      // file is a windows absolute path, strip off the drive letter
      $config = substr($config, 3);
    }

    // replace unfriendly filename characters with an underscore
    $config  = str_replace(array('\\', '/'), '_', $config);
    $config .= '.php';

    return sfConfig::get('sf_config_cache_dir').'/'.$config;
  }

  /**
   * Import a configuration file.
   *
   * If the configuration file path is relative, the path itself is relative
   * to the symfony [sf_app_dir] application setting.
   *
   * @param string A filesystem path to a configuration file.
   * @param bool   Only allow this configuration file to be included once per request?
   *
   * @return void
   */
  public function import($config, $once = true, $optional = false)
  {
    $cache = $this->checkConfig($config, $optional);

    if ($optional && !$cache)
    {
      return;
    }

    // include cache file
    if ($once)
    {
      include_once($cache);
    }
    else
    {
      include($cache);
    }
  }

  /**
   * Load all configuration application and module level handlers.
   *
   * @return void
   *
   * @throws <b>sfConfigurationException</b> If a configuration related error
   *                                       occurs.
   */
  private function loadConfigHandlers()
  {
    // manually create our config_handlers.yml handler
    $this->handlers['config_handlers.yml'] = new sfRootConfigHandler();
    $this->handlers['config_handlers.yml']->initialize();

    // application configuration handlers

    require_once($this->checkConfig(sfConfig::get('sf_app_config_dir_name').'/config_handlers.yml'));

    // module level configuration handlers

    // make sure our modules directory exists
    if (is_readable($sf_app_module_dir = sfConfig::get('sf_app_module_dir')))
    {
      // ignore names
      $ignore = array('.', '..', 'CVS', '.svn');

      // create a file pointer to the module dir
      $fp = opendir($sf_app_module_dir);

      // loop through the directory and grab the modules
      while (($directory = readdir($fp)) !== false)
      {
        if (!in_array($directory, $ignore))
        {
          $configPath = $sf_app_module_dir.'/'.$directory.'/'.sfConfig::get('sf_app_module_config_dir_name').'/config_handlers.yml';

          if (is_readable($configPath))
          {
            // initialize the root configuration handler with this module name
            $params = array('module_level' => true, 'module_name' => $directory);

            $this->handlers['config_handlers.yml']->initialize($params);

            // replace module dir path with a special keyword that
            // checkConfig knows how to use
            $configPath = sfConfig::get('sf_app_module_dir_name').'/'.$directory.'/'.sfConfig::get('sf_app_module_config_dir_name').'/config_handlers.yml';

            require_once($this->checkConfig($configPath));
          }
        }
      }

      // close file pointer
      fclose($fp);
    }
    else
    {
      // module directory doesn't exist or isn't readable
      $error = sprintf('Module directory "%s" does not exist or is not readable',
                       sfConfig::get('sf_app_module_dir'));
      throw new sfConfigurationException($error);
    }
  }

  /**
   * Write a cache file.
   *
   * @param string An absolute filesystem path to a configuration file.
   * @param string An absolute filesystem path to the cache file that will be written.
   * @param string Data to be written to the cache file.
   *
   * @throws sfCacheException If the cache file cannot be written.
   */
  private function writeCacheFile($config, $cache, &$data)
  {
    $fileCache = new sfFileCache(dirname($cache));
    $fileCache->setSuffix('');
    if (!$fileCache->set(basename($cache), '', $data))
    {
      // cannot write cache file
      $error = sprintf('Failed to write cache file "%s" generated from configuration file "%s"', $cache, $config);

      throw new sfCacheException($error);
    }
  }
}
