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
 * DbFinderObjectsRoute represents a route that is bound to a Model class.
 * It can return a list of Model objects or a pager object.
 *
 * @package    DbFinder
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 */
class DbFinderObjectsRoute extends DbFinderRoute
{
  protected
    $model   = null,
    $objects = false,
    $pager   = false;

  public function __construct($pattern, array $defaults = array(), array $requirements = array(), array $options = array())
  {
    if (!isset($options['model']))
    {
      throw new InvalidArgumentException(sprintf('You must pass a "model" option for a %s object (%s).', get_class($this), $pattern));
    }
    $this->model = $options['model'];
    $options = array($this->model => $options);
    parent::__construct($pattern, $defaults, $requirements, $options);
  }
  
  /**
   * Gets the list of objects related to the current route and parameters.
   *
   * This method is only accessible if the route is bound and of type "list".
   *
   * @param integer $limit   The number of results to return (defaults to no limit)
   * @param array   $options Optional associative array overriding the route initialization options
   * 
   * @return array And array of related objects
   */
  public function getObjects($limit = null, $options = array())
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
      $this->setModelOptions($this->model, $options);
    }
    
    $this->objects = $this->getBoundFinder($this->model)->find($limit);
    
    // throw an exception if allow_empty is false (true by default)
    $options = $this->getModelOptions($this->model);
    if (!count($this->objects) && array_key_exists('allow_empty', $options) && !$options['allow_empty'])
    {
      throw new sfError404Exception(sprintf('No %s object found for the following parameters "%s").', $this->model, str_replace("\n", '', var_export($this->filterParameters($this->parameters), true))));
    }

    return $this->objects;
  }
  
  /**
   * Gets a pager of objects related to the current route and parameters.
   *
   * This method is only accessible if the route is bound and of type "pager".
   *
   * @param integer $page The current page (1 by default)
   * @param integer $maxPerPage The maximum number of results per page (10 by default)
   * @param array $options Optional associative array overriding the route initialization options
   *
   * @return array And array of related objects
   */
  public function getObjectPager($page = 1, $maxPerPage = 10, $options = array())
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
      $this->setModelOptions($this->model, $options);
    }
    
    $this->pager = $this->getBoundFinder($this->model)->paginate($page, $maxPerPage);
    
    // throw an exception if allow_empty is false (true by default)
    $options = $this->getModelOptions($this->model);
    if (!$this->pager->getNbResults() && array_key_exists('allow_empty', $options) && !$options['allow_empty'])
    {
      throw new sfError404Exception(sprintf('No %s object found for the following parameters "%s").', $this->model, str_replace("\n", '', var_export($this->filterParameters($this->parameters), true))));
    }
    
    return $this->pager;
  }
  
  public function __call($name, $arguments)
  {
    if($name == ('get' . $this->model . 'Pager'))
    {
      return call_user_func_array(array($this, 'getObjectPager'), $arguments);
    }
    elseif($name == ('get' . $this->model . 's'))
    {
      return call_user_func_array(array($this, 'getObjects'), $arguments);
    }
    throw new Exception(sprintf('Call to undefined method DbFinderObjectsRoute::%s.', $name));
  }
  
}