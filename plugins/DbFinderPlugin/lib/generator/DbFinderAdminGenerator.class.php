<?php

class DbFinderAdminGenerator extends sfGenerator
{
  protected
    $generator = null,
    $orm       = null;
  
  /**
   * Generates classes and templates in cache.
   *
   * @param array The parameters
   *
   * @return string The data to put in configuration cache
   */
  public function generate($params = array())
  {
    if (!isset($params['model_class']))
    {
      $error = 'You must specify a "model_class"';
      $error = sprintf($error, $entry);

      throw new sfParseException($error);
    }
    $modelClass = $params['model_class'];
    if (!class_exists($modelClass))
    {
      $error = 'Unable to scaffold unexistant model "%s"';
      $error = sprintf($error, $modelClass);

      throw new sfInitializationException($error);
    }
    
    list($generatorClass, $type) = DbFinderAdapterUtils::getGenerator($modelClass);
    $this->generator = new $generatorClass($this->generatorManager);
    $this->orm = $type;

    // Manual initialization required for symfony 1.0
    $this->generator->initialize($this->generatorManager);
    $this->generator->setGeneratorClass('DbFinderAdmin');
    $this->generator->DbFinderAdminGenerator = $this;
    
    return $this->generator->generate($params);
  }
  
  public function getColumnType($column)
  {
    $columnFinder = DbFinderAdapterUtils::getColumn($this->orm);
    return call_user_func(array($columnFinder, 'getColumnType'), $column);
  }
  
  public function getColumnSetter($column, $value, $singleQuotes = false, $prefix = 'this->')
  {
    if($this->orm == DbFinderAdapterUtils::PROPEL)
    {
      if ($singleQuotes) $value = sprintf("'%s'", $value);
      return sprintf('$%s%s->set%s(%s)', $prefix, $this->getSingularName(), $column->getPhpName(), $value);
    }
    else
    {
      return $this->generator->getColumnSetter($column, $value, $singleQuotes, $prefix);
    }
  }
  
  public function getColumnLink($column)
  {
    if (!$column->isLink()) return false;
    if ($moduleName = $this->generator->getParameterValue('list.fields.' . $column->getName() . '.link_module'))
    {
      // link to another module
      // FIXME: work with composite pks
      $pkName = $this->generator->getParameterValue('list.fields.' . $column->getName() . '.link_pk_name', 'id');
      return array($moduleName, sprintf("%s='.%s->getPrimaryKey()", $pkName, $this->generator->getColumnGetter($column, true)));
    }
    else
    {
      // link to the current module
      return array($this->generator->getModuleName(), $this->generator->getPrimaryKeyUrlParams());
    }
  }
  
  /** 
   * Returns HTML code for an action option in a select tag.
   * 
   * @param string  The action name 
   * @param array   The parameters 
   * 
   * @return string HTML code 
   */ 
  public function getOptionToAction($actionName, $params) 
  { 
    $options = isset($params['params']) ? sfToolkit::stringToArray($params['params']) : array(); 
    
    // default values 
    if ($actionName[0] == '_') 
    { 
      $actionName = substr($actionName, 1); 
      if ($actionName == 'deleteSelected') 
      { 
        $params['name'] = 'Delete Selected'; 
      } 
    } 
    $name = isset($params['name']) ? $params['name'] : $actionName; 
    
    $options['value'] = $actionName; 
    
    $phpOptions = var_export($options, true); 
    
    return '[?php echo content_tag(\'option\', __(\''.$name.'\')'.($options ? ', '.$phpOptions : '').') ?]'; 
  }
  
  public function __call($method, $arguments)
  {
    return call_user_func_array(array($this->generator, $method), $arguments);
  }
}