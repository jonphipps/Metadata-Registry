<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Admin generator.
 *
 * This class generates an admin module.
 *
 * This class calls two ORM specific methods:
 *   getAllColumns()
 * and
 *   getAdminColumnForField($field, $flag = null)
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelAdminGenerator.class.php 2625 2006-11-07 10:36:14Z fabien $
 */
abstract class sfAdminGenerator extends sfCrudGenerator
{
  protected
    $fields = array();

  /**
   * Returns HTML code for a help icon.
   *
   * @param string The column name
   * @param string The field type (list, edit)
   *
   * @return string HTML code
   */
  public function getHelpAsIcon($column, $type = '')
  {
    $help = $this->getParameterValue($type.'.fields.'.$column->getName().'.help');
    if ($help)
    {
      $tmp = "[?php echo image_tag(sfConfig::get('sf_admin_web_dir').'/images/help.png', array('align' => 'absmiddle', 'alt' => __('".$this->escapeString($help)."'), 'title' => __('".$this->escapeString($help)."'))) ?]";
      if ($type != 'list')
      {
         $tmp = '<div class="sf_admin_icon_edit_help" id="sf_admin_icon_edit_help_' . $column->getName() . '">' . $tmp . "</div>";
      }
      return $tmp;
    }

    return '';
  }

  /**
   * Returns HTML code for a help text.
   *
   * @param string The column name
   * @param string The field type (list, edit)
   *
   * @return string HTML code
   */
  public function getHelp($column, $type = '')
  {
    $help = $this->getParameterValue($type.'.fields.'.$column->getName().'.help');
    if ($help)
    {
      return "<div class=\"sf_admin_edit_help\">[?php echo __('".$this->escapeString($help)."') ?]</div>";
    }

    return '';
  }

  /**
   * Returns HTML code for an action button.
   *
   * @param string  $actionName The action name
   * @param array   $params     The parameters
   * @param boolean $pk_link    (optional) Whether to add a primary key link or not
   * @param string  $pageAction (optional) The action associated with the calling template
   *
   * @return string HTML code
   */
  public function getButtonToAction($actionName, $params, $pk_link = false, $pageAction = null)
  {
    $params   = (array) $params;
    $options  = isset($params['params']) ? sfToolkit::stringToArray($params['params']) : array();
    $method   = 'button_to';
    $li_class = '';
    $only_for = isset($params['only_for']) ? $params['only_for'] : null;
    $route = isset($params['route']) ? $params['route'] : null;

    // default values
    if ($actionName[0] == '_')
    {
      $actionName     = substr($actionName, 1);
      $default_name   = ucfirst(strtr($actionName, '_', ' '));
      $default_icon   = sfConfig::get('sf_admin_web_dir').'/images/'.$actionName.'_icon.png';
      $default_action = $actionName;
      $default_class  = 'sf_admin_action_'.$actionName;

      if ($actionName == 'save' || $actionName == 'save_and_add' || $actionName == 'save_and_list')
      {
        $method = 'submit_tag';
        $options['name'] = $actionName;
      }

      if ($actionName == 'delete')
      {
        $options['post'] = true;
        if (!isset($options['confirm']))
        {
          $options['confirm'] = 'Are you sure?';
        }

        $li_class = ('edit' == $pageAction) ? 'float-left' : 'float-left-show';

        $only_for = 'edit';
      }

      if ($actionName == 'list')
      {
        $pk_link = false;
        if (!isset($options['title']))
        {
          $options['title'] = 'Show ' . $this->getSingularName() . ' list';
        }
      }
    }
    else
    {
      $default_name   = strtr($actionName, '_', ' ');
      $default_icon   = sfConfig::get('sf_admin_web_dir').'/images/default_icon.png';
      $default_action = 'List'.sfInflector::camelize($actionName);
      $default_class  = '';
    }

    $name   = isset($params['name']) ? $params['name'] : $default_name;
    $icon   = isset($params['icon']) ? sfToolkit::replaceConstants($params['icon']) : $default_icon;
    $action = isset($params['action']) ? $params['action'] : $default_action;

    if ($pk_link)
    {
      $url_params = '?'. $this->getPrimaryKeyUrlParams();
    }
    elseif (isset($params['query_string']))
    {
      $qry = '';
      $queryString = $params['query_string'];
      foreach ($queryString as $key => $value)
      {
        $qry[] = $key . '=' . $this->getQueryParam($value);
      }
      if (is_array($qry))
      {
        $qry = implode('&', $qry);
      }
      $url_params = '?'. $qry . "'";
    }
    else
    {
      $url_params = '\'';;
    }

    if (!isset($options['title']))
    {
      $options['title'] = $default_name;
    }

    if (!isset($options['class']) && $default_class)
    {
      $options['class'] = $default_class;
    }
    else
    {
      $options['style'] = 'background: #ffc url('.$icon.') no-repeat 2px 3px; padding-left:20px !important';
    }


    $li_class = $li_class ? ' class="'.$li_class.'"' : '';

    $html = '<li'.$li_class.'>';

    if ($only_for == 'edit')
    {
      $html .= '[?php if ('.$this->getPrimaryKeyIsSet().'): ?]'."\n";
    }
    else if ($only_for == 'create')
    {
      $html .= '[?php if (!'.$this->getPrimaryKeyIsSet().'): ?]'."\n";
    }
    else if ($only_for !== null)
    {
      throw new sfConfigurationException(sprintf('The "only_for" parameter can only take "create" or "edit" as argument ("%s")', $only_for));
    }

    if ($method == 'submit_tag')
    {
      $html .= '[?php echo submit_tag(__(\''.$name.'\'), '.var_export($options, true).') ?]';
    }
    else
    {
      $phpOptions = var_export($options, true);

      // little hack
      $phpOptions = preg_replace("/'confirm' => '(.+?)(?<!\\\)'/", '\'confirm\' => __(\'$1\')', $phpOptions);

      if ($route)
      {
        $actionPath = "@".$route  ;
      }
      else
      {
        $actionPath = $this->getModuleName().'/'.$action;
      }

      $html .= "[?php echo button_to(__('".$name."'), '".$actionPath.$url_params.", ".$phpOptions.") ?]";
    }

    if ($only_for !== null)
    {
      $html .= '[?php endif; ?]'."\n";
    }

    $html .= '</li>'."\n";

    return $html;
  }

  public function getQueryParam($value)
  {
    $qte = $value{0};
    if ($qte == "'" || $qte == '"')
    {
      //it's a string
      return trim($value,"'\"");
    }
    else
    {
      return "'.\$" . $this->getSingularName() . "->get" . sfInflector::camelize($value) . "().'";
    }
  }
  /**
   * Returns HTML code for an action link.
   *
   * @param string  The action name
   * @param array   The parameters
   * @param boolean Whether to add a primary key link or not
   *
   * @return string HTML code
   */
  public function getLinkToAction($actionName, $params, $pk_link = false)
  {
    $options = isset($params['params']) ? sfToolkit::stringToArray($params['params']) : array();

    // default values
    if ($actionName[0] == '_')
    {
      $actionName = substr($actionName, 1);
      $name       = $actionName;
      $icon       = sfConfig::get('sf_admin_web_dir').'/images/'.$actionName.'_icon.png';
      $action     = $actionName;

      if ($actionName == 'delete')
      {
        $options['post'] = true;
        if (!isset($options['confirm']))
        {
          $options['confirm'] = 'Are you sure?';
        }
      }
    }
    else
    {
      $name   = isset($params['name']) ? $params['name'] : $actionName;
      $icon   = isset($params['icon']) ? sfToolkit::replaceConstants($params['icon']) : sfConfig::get('sf_admin_web_dir').'/images/default_icon.png';
      $action = isset($params['action']) ? $params['action'] : 'List'.sfInflector::camelize($actionName);
    }

    $url_params = $pk_link ? '?'.$this->getPrimaryKeyUrlParams() : '\'';

    $phpOptions = var_export($options, true);

    // little hack
    $phpOptions = preg_replace("/'confirm' => '(.+?)(?<!\\\)'/", '\'confirm\' => __(\'$1\')', $phpOptions);

    return '[?php echo link_to(image_tag(\''.$icon.'\', array(\'alt\' => __(\''.$name.'\'), \'title\' => __(\''.$name.'\'))), \''.$this->getModuleName().'/'.$action.$url_params.($options ? ', '.$phpOptions : '').') ?]';
  }

  /**
   * Returns HTML code for a column in edit mode.
   *
   * @param string  The column name
   * @param array   The parameters
   *
   * @return string HTML code
   */
  public function getColumnEditTag($column, $params = array())
  {
    // user defined parameters
    $user_params = $this->getParameterValue('edit.fields.'.$column->getName().'.params');
    $user_params = is_array($user_params) ? $user_params : sfToolkit::stringToArray($user_params);
    $params      = $user_params ? array_merge($params, $user_params) : $params;

    if ($column->isComponent())
    {
      return "get_component('".$this->getModuleName()."', '".$column->getName()."', array('type' => 'edit', '{$this->getSingularName()}' => \${$this->getSingularName()}))";
    }
    else if ($column->isPartial())
    {
      return "get_partial('".$column->getName()."', array('type' => 'edit', '{$this->getSingularName()}' => \${$this->getSingularName()}))";
    }

    // default control name
    $params = array_merge(array('control_name' => $this->getSingularName().'['.$column->getName().']'), $params);

    // default parameter values
    $type = $column->getCreoleType();
    if ($type == CreoleTypes::DATE)
    {
      $params = array_merge(array('rich' => true, 'calendar_button_img' => sfConfig::get('sf_admin_web_dir').'/images/date.png'), $params);
    }
    else if ($type == CreoleTypes::TIMESTAMP)
    {
      $params = array_merge(array('rich' => true, 'withtime' => true, 'calendar_button_img' => sfConfig::get('sf_admin_web_dir').'/images/date.png'), $params);
    }

    // user sets a specific tag to use
    if ($inputType = $this->getParameterValue('edit.fields.'.$column->getName().'.type'))
    {
      if ($inputType == 'plain')
      {
        return $this->getColumnListTag($column, $params);
      }
      else
      {
        return $this->getPHPObjectHelper($inputType, $column, $params);
      }
    }

    // guess the best tag to use with column type
    return parent::getCrudColumnEditTag($column, $params);
  }

  /**
   * Returns all column categories.
   *
   * @param string  The parameter name
   *
   * @return array The column categories
   */
  public function getColumnCategories($paramName)
  {
    if (is_array($this->getParameterValue($paramName)))
    {
      $fields = $this->getParameterValue($paramName);

      // do we have categories?
      if (!isset($fields[0]))
      {
        return array_keys($fields);
      }

    }

    return array('NONE');
  }

  /**
   * Wraps content with a credential condition.
   *
   * This overrides the same function in sfAdminGenerator
   *
   * @param string  The content
   * @param array   The parameters
   *
   * @return string HTML code
   */
  public function addCredentialCondition($content, $params = array(), $inRow = false, $useObjects = false, $actionName = null)
  {
    if (isset($params['credentials']))
    {
      if ($useObjects)
      {
        if ($actionName[0] == '_')
        {
          $actionName = substr($actionName, 1);
        }
        //check the security for some more configuration
        if ($actionName)
        {
          $objectCredArray = myUser::parseSecurity($this->security, $actionName);
          if (isset($objectCredArray['key']))
          {
            $class = $objectCredArray['key']['class'];
            $method = $objectCredArray['key']['method'];
            //$requestParam = $objectCredArray['request_param'];
            //$key = "call_user_func(array('$class', '$method'), \$sf_request->getParameter('$requestParam'))";
            $key = '$' . $class . '->' . $method . '()';
          }
          else if (isset($objectCredArray['request_param']))
          {
            $requestParam = $objectCredArray['request_param'];
            $key = "\$sf_request->getParameter('$requestParam')";
          }
          else
          {
            //only supports non-segmented keys at the moment
            $key = $this->getPrimaryKeyIsSet() ;
          }

          if (isset($objectCredArray['module']))
          {
            $module = $objectCredArray['module'];
          }
          else
          {
            $module = $this->moduleName;
          }

          $insert = "hasObjectCredential($key, '$module', ";
        }
        else
        {
          $insert = 'hasCredential(';
        }
      }
      else
      {
        $insert = 'hasCredential(';
      }

      $credentials = str_replace("\n", ' ', var_export($params['credentials'], true));

      if ($inRow)
      {
         return <<<EOF
[?php if (\$sf_user->$insert $credentials)): ?]
$content
[?php else: ?]
&nbsp;
[?php endif; ?]
EOF;
      }
      else
      {
      return <<<EOF
[?php if (\$sf_user->$insert $credentials)): ?]
$content [?php endif; ?]

EOF;
      }
    }
    else
    {
      return $content;
    }
  }

  /**
   * Gets sfAdminColumn objects for a given category.
   *
   * @param string The parameter name
   *
   * @return array sfAdminColumn array
   */
  public function getColumns($paramName, $category = 'NONE')
  {
    $phpNames = array();

    // user has set a personnalized list of fields?
    $fields = $this->getParameterValue($paramName);
    if (is_array($fields))
    {
      // categories?
      if (isset($fields[0]))
      {
        // simulate a default one
        $fields = array($category => $fields);
      }

      if (!$fields)
      {
        return array();
      }

      //if there's a specific fields array, use $fields[$category]['fields'] instead of $fields[$category]
      if (isset($fields[$category]['fields']))
      {
         $fieldsArray = $fields[$category]['fields'];
      }
      elseif (isset($fields[$category]))
      {
         $fieldsArray = $fields[$category];
      }
      else
      {
         $fieldsArray = $fields;
      }


      foreach ($fieldsArray as $field)
      {
        list($field, $flags) = $this->splitFlag($field);

        $phpNames[] = $this->getAdminColumnForField($field, $flags);
      }
    }
    else
    {
      // no, just return the full list of columns in table
      return $this->getAllColumns();
    }

    return $phpNames;
  }

  /**
   * Gets modifier flags from a column name.
   *
   * @param string The column name
   *
   * @return array An array of detected flags
   */
  public function splitFlag($text)
  {
    $flags = array();
    while (in_array($text[0], array('=', '-', '+', '_', '~')))
    {
      $flags[] = $text[0];
      $text = substr($text, 1);
    }

    return array($text, $flags);
  }

  /**
   * Gets a parameter value.
   *
   * @param string The key name
   * @param mixed  The default value
   *
   * @return mixed The parameter value
   */
  public function getParameterValue($key, $default = null)
  {
    if (preg_match('/^([^\.]+)\.fields\.(.+)$/', $key, $matches))
    {
      return $this->getFieldParameterValue($matches[2], $matches[1], $default);
    }
    else
    {
      return $this->getValueFromKey($key, $default);
    }
  }

  /**
   * Gets a field parameter value.
   *
   * @param string The key name
   * @param string The type (list, edit)
   * @param mixed  The default value
   *
   * @return mixed The parameter value
   */
  protected function getFieldParameterValue($key, $type = '', $default = null)
  {
    $retval = $this->getValueFromKey($type.'.fields.'.$key, $default);
    if ($retval !== null)
    {
      return $retval;
    }

    $retval = $this->getValueFromKey('fields.'.$key, $default);
    if ($retval !== null)
    {
      return $retval;
    }

    if (preg_match('/\.name$/', $key))
    {
      // default field.name
      return sfInflector::humanize(($pos = strpos($key, '.')) ? substr($key, 0, $pos) : $key);
    }
    else
    {
      return null;
    }
  }

  /**
   * Gets the value for a given key.
   *
   * @param string The key name
   * @param mixed  The default value
   *
   * @return mixed The key value
   */
  protected function getValueFromKey($key, $default = null)
  {
    $ref   =& $this->params;
    $parts =  explode('.', $key);
    $count =  count($parts);
    for ($i = 0; $i < $count; $i++)
    {
      $partKey = $parts[$i];
      if (!isset($ref[$partKey]))
      {
        return $default;
      }

      if ($count == $i + 1)
      {
        return $ref[$partKey];
      }
      else
      {
        $ref =& $ref[$partKey];
      }
    }

    return $default;
  }

  /**
   * Wraps a content for I18N.
   *
   * @param string The key name
   * @param string The defaul value
   *
   * @return string HTML code
   */
  public function getI18NString($key, $default = null, $withEcho = true)
  {
    $value = $this->escapeString($this->getParameterValue($key, $default));

    // find %%xx%% strings
    preg_match_all('/%%([^%]+)%%/', $value, $matches, PREG_PATTERN_ORDER);
    $this->params['tmp']['display'] = array();
    foreach ($matches[1] as $name)
    {
      $this->params['tmp']['display'][] = $name;
    }

    $vars = array();
    foreach ($this->getColumns('tmp.display') as $column)
    {
      if ($column->isLink())
      {
        $vars[] = '\'%%'.$column->getName().'%%\' => link_to('.$this->getColumnListTag($column).', \''.$this->getModuleName().'/show?'.$this->getPrimaryKeyUrlParams().')';
      }
      elseif ($column->isPartial())
      {
        $vars[] = '\'%%_'.$column->getName().'%%\' => '.$this->getColumnListTag($column);
      }
      else if ($column->isComponent())
      {
        $vars[] = '\'%%~'.$column->getName().'%%\' => '.$this->getColumnListTag($column);
      }
      else
      {
        $vars[] = '\'%%'.$column->getName().'%%\' => '.$this->getColumnListTag($column);
      }
    }

    // strip all = signs
    $value = preg_replace('/%%=([^%]+)%%/', '%%$1%%', $value);

    $i18n = '__(\''.$value.'\', '."\n".'array('.implode(",\n", $vars).'))';

    return $withEcho ? '[?php echo '.$i18n.' ?]' : $i18n;
  }

  /**
   * Replaces constants in a string.
   *
   * @param string
   *
   * @return string
   */
  public function replaceConstants($value, $developed = true)
  {
    // find %%xx%% strings
    preg_match_all('/%%([^%]+)%%/', $value, $matches, PREG_PATTERN_ORDER);
    $this->params['tmp']['display'] = array();
    foreach ($matches[1] as $name)
    {
      $this->params['tmp']['display'][] = $name;
    }

    foreach ($this->getColumns('tmp.display') as $column)
    {
      $value = str_replace('%%'.$column->getName().'%%', (($developed) ? '{' : '').$this->getColumnGetter($column, $developed, 'this->').(($developed) ? '}' : ''), $value);
    }

    return $value;
  }

  /**
   * Sends the proper params to getColumnTag for the 'list' action, for BC.
   *
   * @param string  $column The column name
   * @param array   $params The parameters
   */
  public function getColumnListTag($column, $params = array())
  {
    return $this->getColumnTag($column, $params, 'list');
  }

  /**
   * Sends the proper params to getColumnTag for the 'show' action, for BC.
   *
   * @param string  $column The column name
   * @param array   $params The parameters
   */
  public function getColumnShowTag($column, $params = array())
  {
    return $this->getColumnTag($column, $params, 'show');
  }

  /**
   * Returns HTML code for a column in list or show mode.
   *
   * @param string  $column The column name
   * @param array   $params The parameters
   * @param array   $action The action - list or show
   *
   * @return string HTML code
   */
  public function getColumnTag($column, $params = array(), $action = 'list')
  {
    $user_params = $this->getParameterValue($action.'.fields.'.$column->getName().'.params');
    $user_params = is_array($user_params) ? $user_params : sfToolkit::stringToArray($user_params);
    $params      = $user_params ? array_merge($params, $user_params) : $params;

    $type = $column->getCreoleType();

    $columnGetter = $this->getColumnGetter($column, true);

    if ($column->isComponent())
    {
      return "get_component('".$this->getModuleName()."', '".$column->getName()."', array('type' => 'list', '{$this->getSingularName()}' => \${$this->getSingularName()}))";
    }
    else if ($column->isPartial())
    {
      return "get_partial('".$column->getName()."', array('type' => 'list', '{$this->getSingularName()}' => \${$this->getSingularName()}))";
    }
    else if ($type == CreoleTypes::DATE || $type == CreoleTypes::TIMESTAMP)
    {
      $format = isset($params['date_format']) ? $params['date_format'] : ($type == CreoleTypes::DATE ? 'D' : 'f');
      return "($columnGetter !== null && $columnGetter !== '') ? format_date($columnGetter, \"$format\") : ''";
    }
    elseif ($type == CreoleTypes::BOOLEAN)
    {
      return "$columnGetter ? image_tag(sfConfig::get('sf_admin_web_dir').'/images/tick.png') : '&nbsp;'";
    }
    else
    {
      return "$columnGetter";
    }
  }

  /**
   * Returns HTML code for a column in filter mode.
   *
   * @param string  The column name
   * @param array   The parameters
   *
   * @return string HTML code
   */
  public function getColumnFilterTag($column, $params = array())
  {
    $user_params = $this->getParameterValue('list.fields.'.$column->getName().'.params');
    $user_params = is_array($user_params) ? $user_params : sfToolkit::stringToArray($user_params);
    $params      = $user_params ? array_merge($params, $user_params) : $params;

    if ($column->isComponent())
    {
      return "get_component('".$this->getModuleName()."', '".$column->getName()."', array('type' => 'filter'))";
    }
    else if ($column->isPartial())
    {
      return "get_partial('".$column->getName()."', array('type' => 'filter', 'filters' => \$filters))";
    }

    $type = $column->getCreoleType();

    $default_value = "isset(\$filters['".$column->getName()."']) ? \$filters['".$column->getName()."'] : null";
    $unquotedName = 'filters['.$column->getName().']';
    $name = "'$unquotedName'";

    if ($column->isForeignKey())
    {

      $related_class = isset($params['related_class']) ? $params['related_class'] : $this->getRelatedClassName($column);
      $peer_method = isset($params['peer_method']) ? $params['peer_method'] : false;
      $text_method = isset($params['text_method']) ? $params['text_method'] : '__toString' ;

      $paramArray = array('include_blank' => true, 'related_class'=>$related_class, 'text_method'=>$text_method, 'control_name'=>$unquotedName);
      if ($peer_method)
      {
        $paramArray['peer_method'] = $peer_method;
      }
      $params = $this->getObjectTagParams($params, $paramArray);
      return "object_select_tag($default_value, null, $params)";

    }
    else if ($type == CreoleTypes::DATE)
    {
      // rich=false not yet implemented
      $params = $this->getObjectTagParams($params, array('rich' => true, 'calendar_button_img' => sfConfig::get('sf_admin_web_dir').'/images/date.png'));
      return "input_date_range_tag($name, $default_value, $params)";
    }
    else if ($type == CreoleTypes::TIMESTAMP)
    {
      // rich=false not yet implemented
      $params = $this->getObjectTagParams($params, array('rich' => true, 'withtime' => true, 'calendar_button_img' => sfConfig::get('sf_admin_web_dir').'/images/date.png'));
      return "input_date_range_tag($name, $default_value, $params)";
    }
    else if ($type == CreoleTypes::BOOLEAN)
    {
      $defaultIncludeCustom = '__("yes or no")';

      $option_params = $this->getObjectTagParams($params, array('include_custom' => $defaultIncludeCustom));
      $params = $this->getObjectTagParams($params);

      // little hack
      $option_params = preg_replace("/'".preg_quote($defaultIncludeCustom)."'/", $defaultIncludeCustom, $option_params);

      $options = "options_for_select(array(1 => __('yes'), 0 => __('no')), $default_value, $option_params)";

      return "select_tag($name, $options, $params)";
    }
    else if ($type == CreoleTypes::CHAR || $type == CreoleTypes::VARCHAR || $type == CreoleTypes::TEXT || $type == CreoleTypes::LONGVARCHAR)
    {
      $max = $this->getParameterValue('defaults.filter.char_max', 15);
      $size = ($column->getSize() < $max ? $column->getSize() : $max);
      $params = $this->getObjectTagParams($params, array('size' => $size));
      return "input_tag($name, $default_value, $params)";
    }
    else if ($type == CreoleTypes::INTEGER || $type == CreoleTypes::TINYINT || $type == CreoleTypes::SMALLINT || $type == CreoleTypes::BIGINT)
    {
      $size = $this->getParameterValue('defaults.filter.int_size', 7);
      $params = $this->getObjectTagParams($params, array('size' => $size));
      return "input_tag($name, $default_value, $params)";
    }
    else if ($type == CreoleTypes::FLOAT || $type == CreoleTypes::DOUBLE || $type == CreoleTypes::DECIMAL || $type == CreoleTypes::NUMERIC || $type == CreoleTypes::REAL)
    {
      $size = $this->getParameterValue('defaults.filter.float_size', 7);
      $params = $this->getObjectTagParams($params, array('size' => $size));
      return "input_tag($name, $default_value, $params)";
    }
    else
    {
      $params = $this->getObjectTagParams($params, array('disabled' => true));
      return "input_tag($name, $default_value, $params)";
    }
  }

  /**
   * Escapes a string.
   *
   * @param string
   *
   * @param string
   */
  protected function escapeString($string)
  {
    return preg_replace('/\'/', '\\\'', $string);
  }
}

/**
 * Propel admin generator column.
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelAdminGenerator.class.php 2625 2006-11-07 10:36:14Z fabien $
 */
class sfAdminColumn
{
  protected
    $phpName    = '',
    $column     = null,
    $flags      = array();

  /**
   * Constructor.
   *
   * @param string The column php name
   * @param string The column name
   * @param array  The column flags
   */
  public function __construct($phpName, $column = null, $flags = array())
  {
    $this->phpName = $phpName;
    $this->column  = $column;
    $this->flags   = (array) $flags;
  }

  /**
   * Returns true if the column maps a database column.
   *
   * @return boolean true if the column maps a database column, false otherwise
   */
  public function isReal()
  {
    return $this->column ? true : false;
  }

  /**
   * Gets the name of the column.
   *
   * @return string The column name
   */
  public function getName()
  {
    return sfInflector::underscore($this->phpName);
  }

  /**
   * Returns true if the column is a partial.
   *
   * @return boolean true if the column is a partial, false otherwise
   */
  public function isPartial()
  {
    return in_array('_', $this->flags) ? true : false;
  }

  /**
   * Returns true if the column is a component.
   *
   * @return boolean true if the column is a component, false otherwise
   */
  public function isComponent()
  {
    return in_array('~', $this->flags) ? true : false;
  }

  /**
   * Returns true if the column has a link.
   *
   * @return boolean true if the column has a link, false otherwise
   */
  public function isLink()
  {
    return (in_array('=', $this->flags) || $this->isPrimaryKey()) ? true : false;
  }

  /**
   * Gets the php name of the column.
   *
   * @return string The php name
   */
  public function getPhpName()
  {
    return $this->phpName;
  }

  // FIXME: those methods are only used in the propel admin generator
  public function __call($name, $arguments)
  {
    return $this->column ? $this->column->$name() : null;
  }
}
