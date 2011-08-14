<?php 

/**
 * Abstraction class for various caching engines
 * Symfony 1.0 cache engines provide various signatures and options
 * This class wraps all cache engines under a common interface
 * And also works with symfony 1.1 cache engines
 */
class sfPropelFinderCache
{
  protected
    $cache         = null,
    $lifetime      = null,
    $justUsedCache = false;
    
  public function __construct($cache = null, $lifetime = null)
  {
    $this->lifetime = $lifetime;
    if(!is_null($lifetime) && method_exists($cache, 'setLifetime'))
    {
      $cache->setLifetime($lifetime);
    }
    if($cache === true)
    {
      $cache = new sfProcessCache();
    }
    $this->cache = $cache;
  }
  
  public function has($key)
  {
    $this->checkCache();
    return $this->cache->has($key);
  }
  
  public function get($key)
  {
    $this->checkCache();
    $value = $this->cache->get($key);
    return ($value instanceof ArrayObject) ? $value->getArrayCopy() : $value;
  }
  
  public function getIfSet($key)
  {
    if($this->has($key))
    {
      $this->setJustUsedCache(true);
      return $this->get($key);
    }
    else
    {
      $this->setJustUsedCache(false);
      return false;
    }
  }
  
  public function set($key, $value, $lifetime = null)
  {
    $this->checkCache();
    $value = is_array($value) ? new ArrayObject($value) : $value;
    if(defined(get_class($this->cache).'::DEFAULT_NAMESPACE'))
    {
      return $this->cache->set($key, null, $value);
    }
    else
    {
      if(is_null($lifetime)) $lifetime = $this->lifetime;
      return $this->cache->set($key, $value, $lifetime);
    }
  }
  
  public function clear()
  {
    $this->checkCache();
    if(method_exists($this->cache, 'clean'))
    {
      return $this->cache->clean();
    }
    else
    {
      return $this->cache->clear();
    }
  }
  
  public function justUsedCache()
  {
    return $this->justUsedCache;
  }
  
  public function setJustUsedCache($value = true)
  {
    $this->justUsedCache = $value;
  }
  
  protected function checkCache()
  {
    if(!$this->cache)
    {
      throw new Exception('DbFinderCache needs to be initialized with a cache engine');
    }
  }
}