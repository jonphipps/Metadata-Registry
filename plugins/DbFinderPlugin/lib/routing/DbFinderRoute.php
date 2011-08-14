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
 * DbFinderRoute is a parent class for routes bound to a Model class via DbFinder.
 *
 * @package    DbFinder
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
abstract class DbFinderRoute extends sfRequestRoute
{
  protected
    $qs      = null,
    $finders = array();

  /**
   * Constructor.
   *
   * @param string $pattern       The pattern to match
   * @param array  $defaults      An array of default parameter values
   * @param array  $requirements  An array of requirements for parameters (regexes)
   * @param array  $options       An array of options
   *
   * @see sfObjectRoute
   */
  public function __construct($pattern, array $defaults = array(), array $requirements = array(), array $options = array())
  {
    $this->pattern      = trim($pattern);
    $this->defaults     = $defaults;
    $this->requirements = $requirements;
    $this->options      = $options;
  }
  
  public function getModelOptions($key)
  {
    if (!array_key_exists($key, $this->options['models']))
    {
      throw new InvalidArgumentException(sprintf('This route has no %s model defined in its options', $key));
    }
    
    return $this->options['models'][$key];
  }
  
  public function setModelOptions($key, $options)
  {
    $this->options['models'][$key] = array_merge($options, $this->options['models'][$key]);
    return $this->options['models'][$key];
  }
  
  public function setFinder($key, sfModelFinder $finder)
  {
    if (!$this->isBound())
    {
      throw new LogicException('The route is not bound.');
    }

    $this->finders[$key] = $finder;
  }
  
  public function getFinder($key)
  {
    if (!array_key_exists($key, $this->finders))
    {
      $options = $this->getModelOptions($key);
      $finder = DbFinder::from($options['model']);
      if (isset($options['finder_methods']))
      {
        foreach ($options['finder_methods'] as $finder_methods)
        {
          $finder->$finder_methods();
        }
      }
      $this->finders[$key] = $finder;
    }

    return $this->finders[$key];
  }
  
  public function applyConditions($key)
  {
    $finder = $this->getFinder($key);
    $options = $this->getModelOptions($key);
    // Exceptions need to be caught and ignored, so the route must mimick DbFinder::filter() instead of actually using it
    foreach ($this->getRealVariables($key) as $variable)
    {
      $camlVariable = sfInflector::camelize($variable);
      $customMethod = 'filterBy' . $camlVariable;
      if(method_exists($finder, $customMethod))
      {
        $finder->$customMethod($this->parameters[$variable]);
      }
      else
      {
        try
        {
          $finder->filterBy($camlVariable, $this->parameters[$variable]);
        }
        catch (Exception $e)
        {
          // don't add condition if the variable cannot be mapped to a column
        }
      }
    }
    
    return $this;
  }
  
  public function applyFilters($key)
  {
    $finder = $this->getFinder($key);
    $options = $this->getModelOptions($key);
    if(array_key_exists('filter_param', $options) && 
       array_key_exists($options['filter_param'], $this->getQueryString()))
    {
      $allowedFilters = array_key_exists('allowed_filters', $options) ? $options['allowed_filters'] : null;
      $finder->filter($this->getQueryString($options['filter_param']), true, $allowedFilters);
    }
    
    return $this;
  }
  
  public function applyOrder($key)
  {
    $finder = $this->getFinder($key);
    $options = $this->getModelOptions($key);
    if(array_key_exists('order_param', $options) &&
       array_key_exists($options['order_param'], $this->getQueryString()) &&
       array_key_exists('key', $this->getQueryString($options['order_param'])))
    {
      $order = $this->getQueryString($options['order_param']);
      if(array_key_exists('order_keys', $options) &&
        !in_array($order['key'], $options['order_keys']))
      {
        continue;
      }
      $orderColumn = sfInflector::camelize($order['key']);
      $orderDirection = isset($order['direction']) ? $order['direction'] : null;
    }
    elseif(array_key_exists('default_order', $options))
    {
      $order = $options['default_order'];
      $orderColumn = is_array($order) ? sfInflector::camelize($order[0]) : sfInflector::camelize($order);
      $orderDirection = (is_array($order) && isset($order[1])) ? $order[1] : null;
    }
    if(isset($orderColumn))
    {
      if(method_exists($finder, 'orderBy' . $orderColumn))
      {
        call_user_func(array($finder, 'orderBy' . $orderColumn), $orderDirection);
      }
      else
      {
        $finder->orderBy($orderColumn, $orderDirection);
      }
    }
    
    return $this;
  }
  
  public function getBoundFinder($key)
  {
    return $this->
      applyConditions($key)->
      applyFilters($key)->
      applyOrder($key)->
      getFinder($key);
  }
  
  // Why doesn't sfRoute have info on the query string ?
  protected function getQueryString($key = null)
  {
    if ($this->qs == null)
    {
      $uri = explode('?', $this->context['request_uri']);
      if (isset($uri[1]))
      {
        parse_str($uri[1], $this->qs);
      }
      else
      {
        $this->qs = array();
      }
    }
    if (!is_null($key))
    {
      return $this->qs[$key];
    }
    else
    {
      return $this->qs;
    }
  }
  
  protected function filterParameters($parameters)
  {
    if (!is_array($parameters))
    {
      return $parameters;
    }

    $params = array();
    foreach (array_keys($this->variables) as $variable)
    {
      $params[$variable] = $parameters[$variable];
    }

    return $params;
  }

  protected function getRealVariables($key)
  {
    $options = $this->getModelOptions($key);
    if (array_key_exists('filter_variables', $options))
    {
      return $options['filter_variables'];
    }
    
    $variables = array();
    foreach (array_keys($this->variables) as $variable)
    {
      if (0 === strpos($variable, 'sf_') || in_array($variable, array('module', 'action')))
      {
        continue;
      }
      
      $variables[] = $variable;
    }
    
    return $variables;
  }
}