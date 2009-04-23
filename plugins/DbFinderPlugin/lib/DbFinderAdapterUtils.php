<?php

class DbFinderAdapterUtils
{
  const 
    DOCTRINE = "Doctrine",
    PROPEL   = "Propel";
    
  /**
   * Possible DbFinder adapters
   * Allow addition of more adapters by way of app.yml
   */
  protected static function getPossibleAdapters()
  {
    return sfConfig::get('app_DbFinder_adapters', array(
      self::PROPEL => array(
        'model_class'     => 'BaseObject',
        'adapter_class'   => 'sfPropelFinder',
        'generator_class' => 'sfPropelAdminGenerator',
        'column_class'    => 'sfPropelFinderColumn'
      ),
      self::DOCTRINE => array(
        'model_class'     => 'Doctrine_Record',
        'adapter_class'   => 'sfDoctrineFinder',
        'generator_class' => 'sfDoctrineAdminGenerator',
        'column_class'    => 'sfDoctrineFinderColumn'
      )
    ));
  }
  
  static $adaptersParamsFor = array();
  
  /**
   * Find a DbFinder adapter parameters for the provided class
   * Uses an internal static cache for speed
   *
   * @param Mixed  $baseClass  a model object or class name
   *
   * @return Array A list of properties ('name', 'adapter_class', 'generator_class')
   * @throws Exception if the provided parameter doesn't correspond to any supported model
   * @see getPossibleAdapters()
   */
  public static function getParams($baseClass)
  {
    $baseClassName = is_string($baseClass) ? $baseClass : get_class($baseClass);
    if(!array_key_exists($baseClassName, self::$adaptersParamsFor))
    {
      $found = false;
      $baseObject = is_object($baseClass) ? $baseClass : new $baseClass;
      foreach(self::getPossibleAdapters() as $type => $adapterParams)
      {
        if($baseObject instanceof $adapterParams['model_class'])
        {
          self::$adaptersParamsFor[$baseClassName] = array($adapterParams['adapter_class'], $type);
          $found = true;
          continue;
        }
      }
      if(!$found)
      {
        // no adapter found
        throw new Exception(sprintf('DbFinder has no adapter for a model object of class %s', $baseClassName));
      }
    }
    
    return self::$adaptersParamsFor[$baseClassName];
  }
  
  /**
   * Finds the adapter type of a finder based on its class and the adapters configuration
   *
   * @param sfModelFinder $adapter A finder instance
   *
   * @return String an adapter type (self::PROPEL, self::DOCTRINE, or more depending on the configuration)
   * @throws Exception if the provided finder is not supported
   * @see getPossibleAdapters()
   */
  public static function getType($adapter)
  {
    foreach(self::getPossibleAdapters() as $type => $adapterParams)
    {
      if($adapter instanceof $adapterParams['adapter_class'])
      {
        return $type;
      }
    }
    // no adapter found
    throw new Exception(sprintf('DbFinder has no parameters for a finder object of class %s', get_class($adapter)));
  }
  
  public static function getGenerator($modelClass)
  {
    $tmp = new $modelClass();
    foreach(self::getPossibleAdapters() as $type => $adapterParams)
    {
      if($tmp instanceof $adapterParams['model_class'])
      {
        return array($adapterParams['generator_class'], $type);
      }
    }
    // no adapter found
    throw new Exception(sprintf('DbFinder has no generator for a model object of class %s', $modelClass));
  }
  
  public static function getColumn($type)
  {
    foreach (self::getPossibleAdapters() as $adapterType => $adapterParams)
    {
      if($adapterType == $type)
      {
        return $adapterParams['column_class'];
      }
    }
    // no adapter found
    throw new Exception(sprintf('DbFinder has no column finder defined for ORM %s', $ype));
  }
}