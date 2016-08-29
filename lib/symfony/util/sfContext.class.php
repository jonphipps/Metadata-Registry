<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr <sean@code-box.org>
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
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id: sfContext.class.php 415 2008-04-04 19:30:57Z jphipps $
 */
class sfContext
{
    /** @var sfActionStack $actionStack */
    protected $actionStack = null;

    /** @var sfController $controller */
    protected $controller = null;

    /** @var sfDatabaseManager $databaseManager */
    protected $databaseManager = null;

    /** @var sfWebRequest $request */
    protected $request = null;

    /** @var sfWebResponse $response */
    protected $response = null;

    /** @var sfStorage $storage */
    protected $storage = null;

    /** @var sfViewCacheManager $viewCacheManager */
    protected $viewCacheManager = null;

    /** @var sfI18N $i18n */
    protected $i18n = null;

    /** @var sfLogger $logger */
    protected $logger = null;

    /** @var myUser $user */
    protected $user = null;

    /** @var sfContext $instance */
    protected static $instance = null;

  /**
   * Removes current sfContext instance
   *
   * This method only exists for testing purpose. Don't use it in your application code.
   */
  public static function removeInstance()
  {
    self::$instance = null;
  }

  protected function initialize()
  {
    $this->logger = sfLogger::getInstance();
    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->logger->info('{sfContext} initialization');
    }

    if (sfConfig::get('sf_use_database'))
    {
      // setup our database connections
      $this->databaseManager = new sfDatabaseManager();
      $this->databaseManager->initialize();
    }

    // create a new action stack
    $this->actionStack = new sfActionStack();

    // include the factories configuration
    require(sfConfigCache::getInstance()->checkConfig(sfConfig::get('sf_app_config_dir_name').'/factories.yml'));

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
  public function getActionName()
  {
    // get the last action stack entry
    if ($this->actionStack && $lastEntry = $this->actionStack->getLastEntry())
    {
      return $lastEntry->getActionName();
    }
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
   public function getController()
   {
     return $this->controller;
   }


    /**
     * @return sfLogger
     */
    public function getLogger()
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
   * @param string $name A database name.
   *
   * @return mixed A Database instance.
   *
   * @throws <b>sfDatabaseException</b> If the requested database name does not exist.
   */
  public function getDatabaseConnection($name = 'default')
  {
    if ($this->databaseManager != null)
    {
      return $this->databaseManager->getDatabase($name)->getConnection();
    }

    return null;
  }

  public function retrieveObjects($class, $peerMethod)
  {
    $retrievingClass = 'sf'.ucfirst(sfConfig::get('sf_orm', 'propel')).'DataRetriever';

    return call_user_func(array($retrievingClass, 'retrieveObjects'), $class, $peerMethod);
  }

  /**
   * Retrieve the database manager.
   *
   * @return sfDatabaseManager The current sfDatabaseManager instance.
   */
  public function getDatabaseManager()
  {
    return $this->databaseManager;
  }

  /**
   * Retrieve the module directory for this context.
   *
   * @return string An absolute filesystem path to the directory of the
   *                currently executing module, if one is set, otherwise null.
   */
  public function getModuleDirectory()
  {
    // get the last action stack entry
    if ($this->actionStack && $lastEntry = $this->actionStack->getLastEntry())
    {
      return sfConfig::get('sf_app_module_dir').'/'.$lastEntry->getModuleName();
    }
  }

  /**
   * Retrieve the module name for this context.
   *
   * @return string The currently executing module name, if one is set,
   *                otherwise null.
   */
  public function getModuleName()
  {
    // get the last action stack entry
    if ($this->actionStack && $lastEntry = $this->actionStack->getLastEntry())
    {
      return $lastEntry->getModuleName();
    }
  }

  /**
   * Retrieve the current view instance for this context.
   *
   * @return sfView The currently view instance, if one is set,
   *                otherwise null.
   */
  public function getCurrentViewInstance()
  {
    // get the last action stack entry
    if ($this->actionStack && $lastEntry = $this->actionStack->getLastEntry())
    {
      return $lastEntry->getViewInstance();
    }
  }

  /**
   * Retrieve the request.
   *
   * @return sfRequest The current sfRequest implementation instance.
   */
  public function getRequest()
  {
    return $this->request;
  }

  /**
   * Retrieve the response.
   *
   * @return sfWebResponse The current sfResponse implementation instance.
   */
  public function getResponse()
  {
    return $this->response;
  }

  /**
   * Set the response object.
   *
   * @param sfWebResponse $response A sfResponse instance.
   *
   */
  public function setResponse($response)
  {
    $this->response = $response;
  }

  /**
   * Retrieve the storage.
   *
   * @return sfStorage The current sfStorage implementation instance.
   */
  public function getStorage()
  {
    return $this->storage;
  }

  /**
   * Retrieve the view cache manager
   *
   * @return sfViewCacheManager The current sfViewCacheManager implementation instance.
   */
  public function getViewCacheManager()
  {
    return $this->viewCacheManager;
  }

  /**
   * Retrieve the i18n instance
   *
   * @return sfI18N The current sfI18N implementation instance.
   */
  public function getI18N()
  {
    if (!$this->i18n && sfConfig::get('sf_i18n'))
    {
      $this->i18n = sfI18N::getInstance();
      $this->i18n->initialize($this);
    }

    return $this->i18n;
  }

  /**
   * Retrieve the user.
   *
   * @return myUser The current sfUser implementation instance.
   */
  public function getUser()
  {
    return $this->user;
  }

  /**
   * Execute the shutdown procedure.
   *
   * @return void
   */
  public function shutdown()
  {
    // shutdown all factories
    $this->getUser()->shutdown();
    $this->getStorage()->shutdown();
    $this->getRequest()->shutdown();
    $this->getResponse()->shutdown();

    if (sfConfig::get('sf_logging_enabled'))
    {
      $this->getLogger()->shutdown();
    }

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
