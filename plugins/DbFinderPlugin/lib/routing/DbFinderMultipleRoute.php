<?php

/*
 * This file is part of the DbFinder package.
 * (c) Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * DbFinderRoute represents a route that is bound to several Model classes.
 * It can return an instance, a list, and a pager
 *
 * @package    DbFinder
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 */
class DbFinderMultipleRoute extends DbFinderRoute
{
  /**
   * Gets the object related to the current route and parameters.
   *
   * @param string $key The name of the searched Model
   * @param array $options Optional associative array overriding the route initialization options
   *
   * @return Object The related object
   */
  public function getObject($key, $options = array())
  {
    if (!$this->isBound())
    {
      throw new LogicException('The route is not bound.');
    }

    if (false !== $this->object)
    {
      return $this->object;
    }
    
    if(!empty($options))
    {
      $this->setOptions($key, $options);
    }
    
    $this->object = $this->getBoundFinder($key)->findOne();
    
    // throw an exception if allow_empty is false (false by default)
    $options = $this->getModelOptions($key);
    if (!($this->object) && (!array_key_exists('allow_empty', $options) || !$options['allow_empty']))
    {
      throw new sfError404Exception(sprintf('Unable to find the %s object with the following parameters "%s").', $key, str_replace("\n", '', var_export($this->filterParameters($this->parameters), true))));
    }

    return $this->object;
  }
  
  /**
   * Gets the list of objects related to the current route and parameters.
   *
   * This method is only accessible if the route is bound and of type "list".
   *
   * @param string $key The name of the searched Model
   * @param integer $limit   The number of results to return (defaults to no limit)
   * @param array   $options Optional associative array overriding the route initialization options
   * 
   * @return array And array of related objects
   */
  public function getObjects($key, $limit = null, $options = array())
  {
    if (!$this->isBound())
    {
      throw new LogicException('The route is not bound.');
    }

    if (false !== $this->objects)
    {
      return $this->objects;
    }
    
    if(!empty($options))
    {
      $this->setOptions($key, $options);
    }
    
    $this->objects = $this->getBoundFinder($key)->find($limit);
    
    // throw an exception if allow_empty is false (true by default)
    $options = $this->getModelOptions($key);
    if (!count($this->objects) && array_key_exists('allow_empty', $options) && !$options['allow_empty'])
    {
      throw new sfError404Exception(sprintf('No %s object found for the following parameters "%s").', $key, str_replace("\n", '', var_export($this->filterParameters($this->parameters), true))));
    }

    return $this->objects;
  }
  
  /**
   * Gets a pager of objects related to the current route and parameters.
   *
   * This method is only accessible if the route is bound and of type "pager".
   *
   * @param string $key The name of the searched Model
   * @param integer $page The current page (1 by default)
   * @param integer $maxPerPage The maximum number of results per page (10 by default)
   * @param array $options Optional associative array overriding the route initialization options
   *
   * @return array And array of related objects
   */
  public function getObjectPager($key, $page = 1, $maxPerPage = 10, $options = array())
  {
    if (!$this->isBound())
    {
      throw new LogicException('The route is not bound.');
    }

    if (false !== $this->pager)
    {
      return $this->pager;
    }
    
    if(!empty($options))
    {
      $this->setModelOptions($key, $options);
    }
    
    $this->pager = $this->getBoundFinder($key)->paginate($page, $maxPerPage);
    
    // throw an exception if allow_empty is false (true by default)
    $options = $this->getModelOptions($key);
    if (!$this->pager->getNbResults() && array_key_exists('allow_empty', $options) && !$options['allow_empty'])
    {
      throw new sfError404Exception(sprintf('No %s object found for the following parameters "%s").', $key, str_replace("\n", '', var_export($this->filterParameters($this->parameters), true))));
    }
    
    return $this->pager;
  }
  
  public function __call($name, $arguments)
  {
    foreach ($this->options as $key => $value)
    {
      if($name == 'get' . $key)
      {
        return call_user_func_array(array($this, 'getObject'), array($key) + $arguments);
      }
      elseif($name == ('get' . $this->model . 'Pager'))
      {
        return call_user_func_array(array($this, 'getObjectPager'), array($key) + $arguments);
      }
      elseif($name == ('get' . $this->model . 's'))
      {
        return call_user_func_array(array($this, 'getObjects'), array($key) + $arguments);
      }
    }
    throw new Exception(sprintf('Call to undefined method DbFinderMultipleRoute::%s.', $name));
  }
}