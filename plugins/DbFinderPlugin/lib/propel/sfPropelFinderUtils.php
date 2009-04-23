<?php

/*
 * This file is part of the sfPropelFinder package.
 * 
 * (c) 2007 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
class sfPropelFinderUtils
{
  protected static 
    $peerClasses = array(),
    $classes = array();
  
  public static function getPeerClassFromClass($class)
  {
    if(!isset(self::$peerClasses[$class]))
    {
      if(!class_exists($class))
      {
        throw new Exception('Unknown model class '.$class);
      }
      $tmp = new $class();
      self::$peerClasses[$class] = get_class($tmp->getPeer());
    }
    return self::$peerClasses[$class];
  }

  public static function getClassFromPeerClass($peerClass)
  {
    if(!isset(self::$classes[$peerClass]))
    {
      if(!class_exists($peerClass))
      {
        throw new Exception('Unknown model peer class '.$peerClass);
      }
      $omClass = call_user_func(array($peerClass, 'getOMClass'));
      self::$classes[$peerClass] =  substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
    }
    return self::$classes[$peerClass];
  }
  
  /**
   * Return a database-readbale column name using a table alias
   * Example use:
   *     echo sfPropelFinderUtils::getColNameUsingAlias('a', 'CategoryId', 'Article');
   *     => 'a.CATEGORY_ID'
   *
   * @param $alias String The table alias to be used
   * @param $phpName String The column phpName (e.g. 'CategoryId')
   * @param $class String The model class (e.g. 'Article')
   * @param $withPeerClass Boolean optional flag to get the peer class together with the column name
   */
  public static function getColNameUsingAlias($alias, $phpName, $class, $withPeerClass = false)
  {
    // Step 1 : replace alias with regular name
    $peerClass = self::getPeerClassFromClass($class);
    // Step 2 : Transform the PhpName to a Colname
    $column = call_user_func(array($peerClass, 'translateFieldName'), ucfirst($phpName), BasePeer::TYPE_PHPNAME, BasePeer::TYPE_COLNAME);
    // Step 3 : replace the table name with the alias again
    $column = call_user_func(array($peerClass, 'alias'), $alias, $column);
    return $withPeerClass ? array($peerClass, $column) : $column;
  }
  
  public static function getColumnsForPeerClass($peerClass)
  {
    if(class_exists($peerClass))
    {
      $tableMap = call_user_func(array($peerClass, 'getTableMap'));
      return $tableMap->getColumns();
    }
    return false;
  }
}