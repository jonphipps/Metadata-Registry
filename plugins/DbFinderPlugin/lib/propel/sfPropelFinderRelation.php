<?php

/**
* sfPropelFinderRelation
*/
class sfPropelFinderRelation
{
  protected
    $fromClass,
    $toClass,
    $fromColumn,
    $toColumn,
    $alias,
    $type,
    $previousRelation,
    $getPreviousMethod,
    $addToMethod,
    $isI18n = false;
  
  const
    ONE_TO_MANY = false,
    MANY_TO_ONE = true;
    
  public function __construct($fromClass, $fromColumn, $toClass, $toColumn)
  {
    $this->fromClass  = $fromClass;
    $this->fromColumn = $fromColumn;
    $this->toClass    = $toClass;
    $this->toColumn   = $toColumn;
    $this->type = self::MANY_TO_ONE;
  }
  
  public function __toString()
  {
    return sprintf('from: %s (%s), to: %s (%s)', $this->fromClass, $this->fromColumn, $this->toClass, $this->toColumn);
  }
  
  public function getFromClass()
  {
    return $this->fromClass;
  }
  
  public function getFromColumn()
  {
    return $this->fromColumn;
  }
  
  public function setFromColumn($value)
  {
    return $this->fromColumn = $value;
  }

  public function getToClass()
  {
    return $this->toClass;
  }
  
  public function getToColumn()
  {
    return $this->toColumn;
  }
  
  public function setToColumn($value)
  {
    return $this->toColumn = $value;
  }
  
  public function isAlias()
  {
    return !is_null($this->alias);
  }
  
  public function getAlias()
  {
    return $this->alias;
  }

  public function setAlias($alias)
  {
    $this->alias = $alias;
  }
  
  public function isI18n()
  {
    return $this->isI18n;
  }
  
  public function setI18n()
  {
    return $this->isI18n = true;
  }
  
  public function getType()
  {
    return $this->type;
  }
  
  public function getPreviousRelation()
  {
    return $this->previousRelation;
  }
  
  public function setPreviousRelation(sfPropelFinderRelation $rel)
  {
    $this->previousRelation = $rel;
  }
  
  public function getRealFromClass()
  {
    if(is_null($this->previousRelation))
    {
      return $this->getFromClass();
    }
    else
    {
      return $this->getPreviousRelation()->getToClass();
    }
  }
  
  public function getFromColumnPhpName()
  {
    $peerClass = sfPropelFinderUtils::getPeerClassFromClass($this->getRealFromClass());
    return call_user_func(array($peerClass, 'translateFieldName'), $this->getFromColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
  }
  
  public function getObjectToRelate($baseObject)
  {
    if(is_null($this->previousRelation))
    {
      return $baseObject;
    }
    else
    {
      $previousRelation = $this->getPreviousRelation();
      $baseObject = $previousRelation->getObjectToRelate($baseObject);
      if (is_null($this->getPreviousMethod))
      {
        $method = 'get' . $previousRelation->getToClass();
        $columnName = $previousRelation->getFromColumnPhpName();
        $preciseMethod = $method . 'RelatedBy' . $columnName;
        if(method_exists($baseObject, $preciseMethod))
        {
          $this->getPreviousMethod = $preciseMethod;
        }
        elseif(method_exists($baseObject, $method))
        {
          $this->getPreviousMethod = $method;
        }
        else
        {
          throw new Exception('Unable to find foreign key getter method');
        }
      }
      
      $objectToRelate = call_user_func(array($baseObject, $this->getPreviousMethod));
      return $objectToRelate;
    }
  }
  
  public function relateObject($baseObject, $objectToRelate, $isNew = true)
  {
    $baseObject = $this->getObjectToRelate($baseObject);
    
    if(is_null($this->addToMethod))
    {
      $method = 'add' . $this->getRealFromClass();
      $columnName = $this->getFromColumnPhpName();
      $preciseMethod = $method . 'RelatedBy' . $columnName;
      $oneToOneMethod = 'set' . $this->getRealFromClass();
      if(method_exists($objectToRelate, $preciseMethod))
      {
        $this->addToMethod = $preciseMethod;
        $this->initMethod = 'init' . $this->getRealFromClass() . 'sRelatedBy' . $columnName;
      }
      elseif(method_exists($objectToRelate, $method))
      {
        $this->addToMethod = $method;
        $this->initMethod = 'init' . $this->getRealFromClass() . 's';
      }
      elseif(method_exists($objectToRelate, $oneToOneMethod))
      {
        $this->addToMethod = $oneToOneMethod;
        $this->initMethod = null;
      }
      else
      {
        throw new Exception('Unable to find foreign key setter method');
      }
    }
    if($isNew && $this->initMethod)
    {
      call_user_func(array($objectToRelate, $this->initMethod));
    }
    call_user_func(array($objectToRelate, $this->addToMethod), $baseObject);
  }
  
  public function relateI18nObject($baseObject, $objectToRelate, $culture)
  {
    $methodName = 'set'.$this->getToClass().'ForCulture';
    if(method_exists($baseObject, $methodName))
    {
      call_user_func(array($baseObject, $methodName), $objectToRelate, $culture);
      call_user_func(array($objectToRelate, 'set'.$this->getFromClass()), $baseObject);
    }
    else
    {
      throw new Exception('Unable to find foreign I18N setter method');
    }
  }
  
  public function addSelectColumns($c)
  {
    $peerClass = sfPropelFinderUtils::getPeerClassFromClass($this->getToClass());
    foreach(call_user_func(array($peerClass, 'getFieldNames'), BasePeer::TYPE_COLNAME) as $column)
    {
      if ($this->isAlias())
      {
        $column = call_user_func(array($peerClass, 'alias'), $this->getAlias(), $column);
      }
      $c->addSelectColumn($column);
    }
    
    return $c;
  }
  
  public function reverse()
  {
    $fromClass  = $this->fromClass;
    $fromColumn = $this->fromColumn;
    $this->fromClass  = $this->toClass;
    $this->fromColumn = $this->toColumn;
    $this->toClass    = $fromClass;
    $this->toColumn   = $fromColumn;
    $this->type = !$this->type;
    
    return $this;
  }

}
