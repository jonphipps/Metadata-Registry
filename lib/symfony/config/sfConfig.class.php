<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfConfig stores all configuration information for a symfony application.
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 */
class sfConfig
{
  private static
    $config = array();

  /**
   * Retrieve a config parameter.
   *
   * @param string A config parameter name.
   * @param mixed  A default config parameter value.
   *
   * @return mixed A config parameter value, if the config parameter exists, otherwise null.
   */
  public static function get ($name, $default = null)
  {
    return isset(self::$config[$name]) ? self::$config[$name] : $default;
  }

  /**
   * Set a config parameter.
   *
   * If a config parameter with the name already exists the value will be overridden.
   *
   * @param string A config parameter name.
   * @param mixed  A config parameter value.
   *
   * @return void
   */
  public static function set ($name, $value)
  {
    self::$config[$name] = $value;
  }

  /**
   * Set an array of config parameters.
   *
   * If an existing config parameter name matches any of the keys in the supplied
   * array, the associated value will be overridden.
   *
   * @param array An associative array of config parameters and their associated values.
   *
   * @return void
   */
  public static function add ($parameters = array())
  {
    self::$config = array_merge(self::$config, $parameters);
  }

  /**
   * Retrieve all configuration parameters.
   *
   * @return array An associative array of configuration parameters.
   */
  public static function getAll ()
  {
    return self::$config;
  }

  /**
   * Clear all current config parameters.
   *
   * @return void
   */
  public static function clear ()
  {
    self::$config = null;
    self::$config = array();
  }
}
