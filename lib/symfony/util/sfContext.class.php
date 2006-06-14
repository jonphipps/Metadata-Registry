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
 * sfContext provides information about the current application context, such as
 * the module and action names and the module directory. References to the
 * current controller, request, and user implementation instances are also
 * provided.
 *
 * @package    symfony
 * @subpackage util
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <skerr@mojavi.org>
 * @version    SVN: $Id$
 */
class sfContext
{
  private
    $actionStack       = null,
    $controller        = null,
    $databaseManager   = null,
    $request           = null,
    $response          = null,
    $storage           = null,
    $securityFilter    = null,
    $viewCacheManager  = null,
    $i18n              = null,
    $logger            = null,
    $user              = null;

  private static
    $instance          = null;

  /**
   * Removes current sfContext instance
   *
   * This method only exists for testing purpose. Don't use it in your application code.
   */
  public static function removeInstance()
  {
    self::$instance = null;
  }

  private function initialize()
  {
    if (sfConfig::get('sf_logging_active'))
    {
      $this->logger = sfLogger::getInstance();
      $this->logger->info('{sfContext} initialization');
    }

    if (sfConfig::get('sf_use_database'))
    {
      // setup our database connections
      $this->databaseManager = new sfDatabaseManager();
      $this->databaseManager->initialize();
    }

    if ($sf_cache = sfConfig::get('sf_cache'))
    {
      $this->viewCacheManager = new sfViewCacheManager();
    }

    // create a new action stack
    $this->actionStack = new sfActionStack();

    if (sfConfig::get('sf_i18n'))
    {
      $this->i18n = new sfI18N();
      $this->i18n->initialize($this);
      sfConfig::set('sf_i18n_instance', $this->i18n);
    }

    // include the factories configuration
    require(sfConfigCache::getInstance()->checkConfig(sfConfig::get('sf_app_config_dir_name').'/factories.yml'));

    if ($sf_cache)
    {
      $this->viewCacheManager->initialize($this);
    }

    // register our shutdown function
    register_shutdown_function(array($this, 'shutdown'));
  }

  /**
   * Retrieve the singleton instance of this class.
   *
   * @return sfContext A sfContext implementation instance.
   */
  public static function getInstance()
  {
    if (!isset(self::$instance))
    {
      $class = __CLASS__;
      self::$instance = new $class();
      self::$instance->initialize();
    }

    return self::$instance;
  }

  public static function hasInstance()
  {
    return isset(self::$instance);
  }

  /**
   * Retrieve the action name for this context.
   *
   * @return string The currently executing action name, if one is set,
   *                otherwise null.
   */
  public function getActionName ()
  {
    // get the last action stack entry
    $actionEntry = $this->actionStack->getLastEntry();

    return $actionEntry->getActionName();
  }


  /**
   * Retrieve the ActionStack.
   *
   * @return sfActionStack the sfActionStack instance
   */
  public function getActionStack()
  {
    return $this->actionStack;
  }

  /**
   * Retrieve the controller.
   *
   * @return sfController The current sfController implementation instance.
   */
   public function getController ()
   {
     return $this->controller;
   }

   public function getLogger ()
   {
     return $this->logger;
   }

  /**
   * Retrieve a database connection from the database manager.
   *
   * This is a shortcut to manually getting a connection from an existing
   * database implementation instance.
   *
   * If the [sf_use_database] setting is off, this will return null.
   *
   * @param name A database name.
   *
   * @return mixed A Database instance.
   *
   * @throws <b>sfDatabaseException</b> If the requested database name does not exist.
   */
  public function getDatabaseConnection ($name = 'default')
  {
    if ($this->databaseManager != null)
    {
      return $this->databaseManager->getDatabase($name)->getConnection();
    }

    return null;
  }

  /**
   * Retrieve the database manager.
   *
   * @return sfDatabaseManager The current sfDatabaseManager instance.
   */
  public function getDatabaseManager ()
  {
    return $this->databaseManager;
  }

  /**
   * Retrieve the module directory for this context.
   *
   * @return string An absolute filesystem path to the directory of the
   *                currently executing module, if one is set, otherwise null.
   */
  public function getModuleDirectory ()
  {
    // get the last action stack entry
    $actionEntry = $this->actionStack->getLastEntry();

    return $actionEntry ? sfConfig::get('sf_app_module_dir').'/'.$actionEntry->getModuleName() : null;
  }

  /**
   * Retrieve the module name for this context.
   *
   * @return string The currently executing module name, if one is set,
   *                otherwise null.
   */
  public function getModuleName ()
  {
    // get the last action stack entry
    $actionEntry = $this->actionStack->getLastEntry();

    return $actionEntry ? $actionEntry->getModuleName() : null;
  }

  /**
   * Retrieve the curretn view instance for this context.
   *
   * @return sfView The currently view instance, if one is set,
   *                otherwise null.
   */
  public function getCurrentViewInstance ()
  {
    // get the last action stack entry
    $actionEntry = $this->actionStack->getLastEntry();

    return $actionEntry ? $actionEntry->getViewInstance() : null;
  }

  /**
   * Retrieve the request.
   *
   * @return sfRequest The current sfRequest implementation instance.
   */
  public function getRequest ()
  {
    return $this->request;
  }

  /**
   * Retrieve the response.
   *
   * @return sfResponse The current sfResponse implementation instance.
   */
  public function getResponse ()
  {
    return $this->response;
  }

  /**
   * Set the response object.
   *
   * @param sfResponse A sfResponse instance.
   *
   * @return void.
   */
  public function setResponse ($response)
  {
    $this->response = $response;
  }

  /**
   * Retrieve the storage.
   *
   * @return sfStorage The current sfStorage implementation instance.
   */
  public function getStorage ()
  {
    return $this->storage;
  }

  /**
   * Retrieve the securityFilter
   *
   * @return sfSecurityFilter The current sfSecurityFilter implementation instance.
   */
  public function getSecurityFilter ()
  {
    return $this->securityFilter;
  }

  /**
   * Retrieve the view cache manager
   *
   * @return sfViewCacheManager The current sfViewCacheManager implementation instance.
   */
  public function getViewCacheManager ()
  {
    return $this->viewCacheManager;
  }

  /**
   * Retrieve the i18n instance
   *
   * @return sfI18N The current sfI18N implementation instance.
   */
  public function getI18N ()
  {
    return $this->i18n;
  }

  /**
   * Retrieve the user.
   *
   * @return sfUser The current sfUser implementation instance.
   */
  public function getUser ()
  {
    return $this->user;
  }

  /**
   * Execute the shutdown procedure.
   *
   * @return void
   */
  public function shutdown ()
  {
    // shutdown all factories
    $this->getUser()->shutdown();
    $this->getStorage()->shutdown();
    $this->getRequest()->shutdown();
    $this->getResponse()->shutdown();

    if (sfConfig::get('sf_use_database'))
    {
      $this->getDatabaseManager()->shutdown();
    }

    if (sfConfig::get('sf_cache'))
    {
      $this->getViewCacheManager()->shutdown();
    }
  }
}
