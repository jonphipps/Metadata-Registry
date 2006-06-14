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
 * @subpackage cache
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Fabien Marty <fab@php.net>
 * @version    SVN: $Id$
 */
abstract class sfCache
{
  /**
  * Cache lifetime (in seconds)
  *
  * @var int $lifeTime
  */
  protected $lifeTime = 86400;

  /**
  * Timestamp of the last valid cache
  *
  * @var int $refreshTime
  */
  protected $refreshTime;

  /**
  * Test if a cache is available and (if yes) return it
  *
  * @param  string  $id cache id
  * @param  string  $namespace name of the cache namespace
  * @param  boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
  * @return string  data of the cache (or null if no cache available)
  */
  abstract public function get($id, $namespace = self::DEFAULT_NAMESPACE, $doNotTestCacheValidity = false);

  abstract public function has($id, $namespace = self::DEFAULT_NAMESPACE, $doNotTestCacheValidity = false);

  /**
  * Save some data in a cache file
  *
  * @param string $data data to put in cache
  * @param string $id cache id
  * @param string $namespace name of the cache namespace
  * @return boolean true if no problem
  */
  abstract public function set($id, $namespace = self::DEFAULT_NAMESPACE, $data);

  /**
  * Remove a cache file
  *
  * @param string $id cache id
  * @param string $namespace name of the cache namespace
  * @return boolean true if no problem
  */
  abstract public function remove($id, $namespace = self::DEFAULT_NAMESPACE);

  /**
  * Clean the cache
  *
  * if no namespace is specified all cache files will be destroyed
  * else only cache files of the specified namespace will be destroyed
  *
  * @param string $namespace name of the cache namespace
  * @return boolean true if no problem
  */
  abstract public function clean($namespace = null, $mode = 'all');

  /**
  * Set a new life time
  *
  * @param int $newLifeTime new life time (in seconds)
  */
  public function setLifeTime($newLifeTime)
  {
    $this->lifeTime = $newLifeTime;
    $this->refreshTime = time() - $newLifeTime;
  }

  public function getLifeTime()
  {
    return $this->lifeTime;
  }

  /**
  * Return the cache last modification time
  *
  * @return int last modification time
  */
  abstract public function lastModified($id, $namespace = self::DEFAULT_NAMESPACE);
}
