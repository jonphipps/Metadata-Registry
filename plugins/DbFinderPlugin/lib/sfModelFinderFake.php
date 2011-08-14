<?php

/*
 * This file is part of the DbFinder package.
 * 
 * (c) 2009 François Zaninotto <francois.zaninotto@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Fakes a sfModelFinder instance for _if() / _elseif() / _else() / _endif() logic
 */
class sfModelFinderFake
{
  protected $finder;
  
  public function __construct($finder)
  {
    $this->finder = $finder;
  }
  
  public function _if()
  {
    throw new Exception('_if() statements cannot be nested');
  }
  
  public function _elseif($cond)
  {
    if($cond)
    {
      return $this->finder;
    }
    else
    {
      return $this;
    }
  }
  
  public function _else()
  {
    return $this->finder;
  }
  
  public function _endif()
  {
    return $this->finder;
  }
  
  public function __call($name, $arguments)
  {
    return $this;
  }
}