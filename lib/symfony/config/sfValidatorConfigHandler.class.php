<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004-2006 Sean Kerr <sean@code-box.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfValidatorConfigHandler allows you to register validators with the system.
 *
 * @package    symfony
 * @subpackage config
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Sean Kerr <sean@code-box.org>
 * @version    SVN: $Id: sfValidatorConfigHandler.class.php 496 2008-07-22 21:16:09Z jphipps $
 */
class sfValidatorConfigHandler extends sfYamlConfigHandler
{
  /**
   * Executes this configuration handler.
   *
   * @param array An array of absolute filesystem path to a configuration file
   *
   * @return string Data to be written to a cache file
   *
   * @throws sfConfigurationException If a requested configuration file does not exist or is not readable
   * @throws sfParseException If a requested configuration file is improperly formatted
   */
  public function execute($configFiles)
  {
    // parse the yaml
    $config = $this->parseYamls($configFiles);

    // alternate format?
    if (isset($config['fields']))
    {
      $this->convertAlternate2Standard($config);
    }

    foreach (array('methods', 'names') as $category)
    {
      if (!isset($config[$category]))
      {
        if (!isset($config['fillin']))
        {
          throw new sfParseException(sprintf('Configuration file "%s" is missing "%s" category', $configFiles[0], $category));
        }
        $config[$category] = array();
      }
    }

    // init our data, includes, methods, names and validators arrays
    $data       = array();
    $includes   = array();
    $methods    = array();
    $names      = array();
    $validators = array();

    // get a list of methods and their registered files/parameters
    foreach ($config['methods'] as $method => $list)
    {
      $method = strtoupper($method);

      if (!isset($methods[$method]))
      {
        // make sure that this method is GET or POST
        if ($method != 'GET' && $method != 'POST')
        {
          // unsupported request method
          $error = sprintf('Configuration file "%s" specifies unsupported request method "%s"', $configFiles[0], $method);

          throw new sfParseException($error);
        }

        // create our method
        $methods[$method] = array();
      }

      if (!count($list))
      {
        // we have an empty list of names
        continue;
      }

      // load name list
      $this->loadNames($configFiles, $method, $methods, $names, $config, $list);
    }

    // load attribute list
    $this->loadAttributes($configFiles, $methods, $names, $validators, $config, $list);

    // fill-in filter configuration
    $fillin = var_export(isset($config['fillin']) ? $config['fillin'] : array(), true);

    // generate GET file/parameter data

    $data[] = "if (\$_SERVER['REQUEST_METHOD'] == 'GET')";
    $data[] = "{";

    $this->generateRegistration('GET', $data, $methods, $names, $validators);

    if (count($fillin))
    {
      $data[] = sprintf("  \$context->getRequest()->setAttribute('fillin', %s, 'symfony/filter');", $fillin);
    }

    // generate POST file/parameter data

    $data[] = "}";
    $data[] = "else if (\$_SERVER['REQUEST_METHOD'] == 'POST')";
    $data[] = "{";

    $this->generateRegistration('POST', $data, $methods, $names, $validators);

    if (count($fillin))
    {
      $data[] = sprintf("  \$context->getRequest()->setAttribute('fillin', %s, 'symfony/filter');", $fillin);
    }

    $data[] = "}";

    // compile data
    $retval = sprintf("<?php\n".
                      "// auto-generated by sfValidatorConfigHandler\n".
                      "// date: %s\n%s\n%s\n", date('Y/m/d H:i:s'),
                      implode("\n", $includes), implode("\n", $data));

    return $retval;
  }

  /**
   * Generates raw cache data.
   *
   * @param string A request method
   * @param array  The data array where our cache code will be appended
   * @param array  An associative array of request method data
   * @param array  An associative array of file/parameter data
   * @param array  A validators array
   *
   * @return boolean Returns true if there is some validators for this file/parameter
   */
  protected function generateRegistration($method, &$data, &$methods, &$names, &$validators)
  {
    // setup validator array
    $data[] = "  \$validators = array();";

    if (!isset($methods[$method]))
    {
      $methods[$method] = array();
    }

    // determine which validators we need to create for this request method
    foreach ($methods[$method] as $name)
    {
      if (preg_match('/^([a-z0-9_-]+)\{([a-z0-9\s_-]+)\}$/i', $name, $match))
      {
        // this file/parameter has a parent
        $subname = $match[2];
        $parent  = $match[1];

        $valList = $names[$parent][$subname]['validators'];
      }
      else
      {
        // no parent
        $valList = $names[$name]['validators'];
      }

      if ($valList == null)
      {
        // no validator list for this file/parameter
        continue;
      }

      foreach ($valList as $valName)
      {
        if (isset($validators[$valName]) && !isset($validators[$valName][$method]))
        {
          // retrieve this validator's info
          $validator =& $validators[$valName];

          $data[] = sprintf("  \$validators['%s'] = new %s();\n".
                            "  \$validators['%s']->initialize(%s, %s);",
                            $valName, $validator['class'], $valName, '$context', $validator['parameters']);

          // mark this validator as created for this request method
          $validators[$valName][$method] = true;
        }
      }
    }

    foreach ($methods[$method] as $name)
    {
      if (preg_match('/^([a-z0-9_-]+)\{([a-z0-9\s_-]+)\}$/i', $name, $match))
      {
        // this file/parameter has a parent
        $subname = $match[2];
        $parent  = $match[1];
        $name    = $match[2];

        $attributes = $names[$parent][$subname];
      }
      else
      {
        // no parent
        $attributes = $names[$name];
      }

      // register file/parameter
      $data[] = sprintf("  \$validatorManager->registerName('%s', %s, %s, %s, %s, %s);",
                        $name, $attributes['required'] ? 1 : 0,
                        isset($attributes['required_msg']) ? $attributes['required_msg'] : "''",
                        $attributes['parent'], $attributes['group'],
                        $attributes['file']);

      // register validators for this file/parameter
      foreach ($attributes['validators'] as &$validator)
      {
        $data[] = sprintf("  \$validatorManager->registerValidator('%s', %s, %s);", $name,
                          "\$validators['$validator']",
                          $attributes['parent']);
      }
    }

    return count($methods[$method]) ? true : false;
  }

  /**
   * Loads the linear list of attributes from the [names] category.
   *
   * @param string The configuration file name (for exception usage)
   * @param array  An associative array of request method data
   * @param array  An associative array of file/parameter names in which to store loaded information
   * @param array  An associative array of validator data
   * @param array  The loaded ini configuration that we'll use for verification purposes
   * @param string A comma delimited list of file/parameter names
   */
  protected function loadAttributes(&$configFiles, &$methods, &$names, &$validators, &$config, &$list)
  {
    foreach ($config['names'] as $name => $attributes)
    {
      // get a reference to the name entry
      if (preg_match('/^([a-z0-9_-]+)\{([a-z0-9\s_-]+)\}$/i', $name, $match))
      {
        // this name entry has a parent
        $subname = $match[2];
        $parent  = $match[1];

        if (!isset($names[$parent][$subname]))
        {
          // unknown parent or subname
          $error = sprintf('Configuration file "%s" specifies unregistered parent "%s" or subname "%s"', $configFiles[0], $parent, $subname);
          throw new sfParseException($error);
        }

        $entry =& $names[$parent][$subname];
      }
      else
      {
        // no parent
        if (!isset($names[$name]))
        {
          // unknown name
          $error = sprintf('Configuration file "%s" specifies unregistered name "%s"', $configFiles[0], $name);
          throw new sfParseException($error);
        }

        $entry =& $names[$name];
      }

      foreach ($attributes as $attribute => $value)
      {
        if ($attribute == 'validators')
        {
          // load validators for this file/parameter name
          $this->loadValidators($configFiles, $validators, $config, $value, $entry);
        }
        else if ($attribute == 'type')
        {
          // name type
          $lvalue = strtolower($value);
          $entry['file'] = ($lvalue == 'file' ? 'true' : 'false');
        }
        else
        {
          // just a normal attribute
          $entry[$attribute] = sfToolkit::literalize($value, true);
        }
      }
    }
  }

  /**
   * Loads all request methods and the file/parameter names that will be
   * validated from the [methods] category.
   *
   * @param string The configuration file name (for exception usage)
   * @param string A request method
   * @param array  An associative array of request method data
   * @param array  An associative array of file/parameter names in which to store loaded information
   * @param array  The loaded ini configuration that we'll use for verification purposes
   * @param string A comma delimited list of file/parameter names
   */
  protected function loadNames(&$configFiles, &$method, &$methods, &$names, &$config, &$list)
  {
    // explode the list of names
    $array = $list;

    // loop through the names
    foreach ($array as $name)
    {
      // make sure we have the required status of this file or parameter
      if (!isset($config['names'][$name]['required']))
      {
        // missing 'required' attribute
        $error = sprintf('Configuration file "%s" specifies file or parameter "%s", but it is missing the "required" attribute', $configFiles[0], $name);
        throw new sfParseException($error);
      }

      // determine parent status
      if (preg_match('/^([a-z0-9_-]+)\{([a-z0-9\s_-]+)\}$/i', $name, $match))
      {
        // this name has a parent
        $subname = $match[2];
        $parent  = $match[1];

        if (!isset($names[$parent]) || !isset($names[$parent][$name]))
        {
          if (!isset($names[$parent]))
          {
            // create our parent
            $names[$parent] = array('_is_parent' => true);
          }

          // create our new name entry
          $entry                 = array();
          $entry['file']         = 'false';
          $entry['group']        = 'null';
          $entry['parent']       = "'$parent'";
          $entry['required']     = 'true';
          $entry['required_msg'] = "'Required'";
          $entry['validators']   = array();

          // add our name entry
          $names[$parent][$subname] = $entry;
        }
      }
      else if (strpos($name, '{') !== false || strpos($name, '}') !== false)
      {
        // name contains an invalid character
        // this is most likely a typo where the user forgot to add a brace
        $error = sprintf('Configuration file "%s" specifies method "%s" with invalid file/parameter name "%s"', $configFiles[0], $method, $name);
        throw new sfParseException($error);
      }
      else
      {
        // no parent
        if (!isset($names[$name]))
        {
          // create our new name entry
          $entry                 = array();
          $entry['file']         = 'false';
          $entry['group']        = 'null';
          $entry['parent']       = 'null';
          $entry['required']     = 'true';
          $entry['required_msg'] = "'Required'";
          $entry['type']         = 'parameter';
          $entry['validators']   = array();

          // add our name entry
          $names[$name] = $entry;
        }
      }

      // add this name to the current request method
      $methods[$method][] = $name;
    }
  }

  /**
   * Loads a list of validators.
   *
   * @param string The configuration file name (for exception usage)
   * @param array  An associative array of validator data
   * @param array  The loaded ini configuration that we'll use for verification purposes
   * @param string A comma delimited list of validator names
   * @param array  A file/parameter name entry
   */
  protected function loadValidators(&$configFiles, &$validators, &$config, &$list, &$entry)
  {
    // create our empty entry validator array
    $entry['validators'] = array();

    if (!$list || (!is_array($list) && trim($list) == ''))
    {
      // skip the empty list
      return;
    }

    // get our validator array
    $array = is_array($list) ? $list : explode(',', $list);

    foreach ($array as $validator)
    {
      $validator = trim($validator);

      // add this validator name to our entry
      $entry['validators'][] = $validator;

      // make sure the specified validator exists
      if (!isset($config[$validator]))
      {
        // validator hasn't been registered
        $error = sprintf('Configuration file "%s" specifies unregistered validator "%s"', $configFiles[0], $validator);
        throw new sfParseException($error);
      }

      // has it already been registered?
      if (isset($validators[$validator]))
      {
        continue;
      }

      if (!isset($config[$validator]['class']))
      {
        // missing class key
        $error = sprintf('Configuration file "%s" specifies category "%s" with missing class key', $configFiles[0], $validator);
        throw new sfParseException($error);
      }

      // create our validator
      $validators[$validator]               = array();
      $validators[$validator]['class']      = $config[$validator]['class'];
      $validators[$validator]['file']       = null;
      $validators[$validator]['parameters'] = null;

      if (isset($config[$validator]['file']))
      {
        // we have a file for this validator
        $file = $config[$validator]['file'];

        // keyword replacement
        $file = $this->replaceConstants($file);
        $file = $this->replacePath($file);

        if (!is_readable($file))
        {
          // file doesn't exist
          $error = sprintf('Configuration file "%s" specifies category "%s" with nonexistent or unreadable file "%s"', $configFiles[0], $validator, $file);
          throw new sfParseException($error);
        }

        $validators[$validator]['file'] = $file;
      }

      // parse parameters
      $parameters = (isset($config[$validator]['param']) ? var_export($config[$validator]['param'], true) : 'null');

      $validators[$validator]['parameters'] = $parameters;
    }
  }

  /**
   * Converts alternate format to standard format.
   *
   * @param array  Configuration data
   */
  protected function convertAlternate2Standard(&$config)
  {
    $defaultMethods = isset($config['methods']) ? $config['methods'] : array('post');
    $config['methods'] = array();

    // validators
    if (isset($config['validators']))
    {
      foreach ((array) $config['validators'] as $validator => $params)
      {
        $config[$validator] = $params;
      }

      unset($config['validators']);
    }

    // names
    $config['names'] = $config['fields'];
    unset($config['fields']);

    foreach ($config['names'] as $name => $values)
    {
      // validators
      $validators = array();
      foreach ($values as $validator => $params)
      {
        if (in_array($validator, array('required', 'group', 'group_msg', 'parent', 'file', 'methods')))
        {
          continue;
        }

        // class or validator
        if (!isset($config[$validator]))
        {
          $config[$validator] = array('class' => $validator);
        }

        $validatorName = $validator;
        if ($params)
        {
          // create a new validator
          $validatorName = $validator.'_'.$name;
          $config[$validatorName] = $config[$validator];
          $config[$validatorName]['param'] = array_merge(isset($config[$validator]['param']) ? (array) $config[$validator]['param'] : array(), $params);
        }

        $validators[] = $validatorName;

        unset($values[$validator]);
      }
      $values['validators'] = $validators;

      // group
      if (isset($values['group']) && isset($values['group_msg']))
      {
        $values['required_msg'] = $values['group_msg'];
      }

      // required
      if (isset($values['required']))
      {
        $values['required_msg'] = $values['required']['msg'];
        $values['required'] = true;
      }
      else
      {
        $values['required'] = false;
      }

      // methods
      if (isset($values['methods']))
      {
        $methods = (array) $values['methods'];
        unset($values['methods']);
      }
      else
      {
        $methods = $defaultMethods;
      }
      foreach ($methods as $method)
      {
        $config['methods'][$method][] = $name;
      }

      $config['names'][$name] = $values;
    }
  }
}
