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
 * DbFinderObjectRoute represents a route that is bound to a Model class 
 * It can return a single Model object.
 *
 * @package    DbFinder
 * @author     Francois Zaninotto <francois.zaninotto@symfony-project.com>
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class DbFinderObjectRoute extends DbFinderRoute
{
  protected
    $model  = null,
    $object = false;
  
  public function __construct($pattern, array $defaults = array(), array $requirements = array(), array $options = array())
  {
    if (!isset($options['model']))
    {
      throw new InvalidArgumentException(sprintf('You must pass a "model" option for a %s object (%s).', get_class($this), $pattern));
    }
    $this->model = $options['model'];
    $options = array('models' => array($this->model => $options));
    parent::__construct($pattern, $defaults, $requirements, $options);
  }
  
  /**
   * Gets the object related to the current route and parameters.
   *
   * @param array $options Optional associative array overriding the route initialization options
   *
   * @return Object The related object
   */
  public function getObject($options = array())
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
      $this->setModelOptions($this->getModel(), $options);
    }
    
    $this->object = $this->getBoundFinder($this->getModel())->findOne();
    
    // throw an exception if allow_empty is false (false by default)
    $options = $this->getModelOptions($this->getModel());
    if (!($this->object) && (!array_key_exists('allow_empty', $options) || !$options['allow_empty']))
    {
      throw new sfError404Exception(sprintf('Unable to find the %s object with the following parameters "%s").', $this->getModel(), str_replace("\n", '', var_export($this->filterParameters($this->parameters), true))));
    }

    return $this->object;
  }
  
  /**
   * Returns true if the parameters matches this route, false otherwise.
   *
   * @param  mixed  $params  The parameters
   * @param  array  $context The context
   *
   * @return Boolean         true if the parameters matches this route, false otherwise.
   */
  public function matchesParameters($params, $context = array())
  {
    return parent::matchesParameters($this->convertObjectToArray($params));
  }
  
  /**
   * Generates a URL from the given parameters.
   *
   * @param  mixed   $params    The parameter values
   * @param  array   $context   The context
   * @param  Boolean $absolute  Whether to generate an absolute URL
   *
   * @return string The generated URL
   */
  public function generate($params, $context = array(), $absolute = false)
  {
    return parent::generate($this->convertObjectToArray($params), $context, $absolute);
  }
  
  protected function convertObjectToArray($object)
  {
    if (is_array($object))
    {
      if (!isset($object['sf_subject']))
      {
        return $object;
      }

      $parameters = $object;
      $object = $parameters['sf_subject'];
      unset($parameters['sf_subject']);
    }
    else
    {
      $parameters = array();
    }

    return array_merge($parameters, $this->doConvertObjectToArray($object));
  }

  protected function doConvertObjectToArray($object)
  {
    if (isset($this->options[$this->getModel()]['convert']) || method_exists($object, 'toParams'))
    {
      $method = isset($this->options[$this->getModel()]['convert']) ? $this->options[$this->getModel()]['convert'] : 'toParams';

      return $object->$method();
    }

    $parameters = array();
    foreach ($this->getRealVariables($this->getModel()) as $variable)
    {
      try
      {
        $method = 'get'.sfInflector::camelize($variable);
        $parameters[$variable] = call_user_func(array($object, $method));
      }
      catch (Exception $e)
      {
        // don't add value if the variable cannot be mapped to a column
      }
    }

    return $parameters;
  }
  
  public function getModel()
  {
    if(is_null($this->model))
    {
      $this->model = array_shift(array_keys($this->options['models']));
    }
    return $this->model;
  }
  
  public function __call($name, $arguments)
  {
    if($name == 'get' . $this->getModel())
    {
      return call_user_func_array(array($this, 'getObject'), $arguments);
    }
    throw new Exception(sprintf('Call to undefined method DbFinderObjectRoute::%s.', $name));
  }
}