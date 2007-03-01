<?php

class sfControlPanelGenerator extends sfPropelAdminGenerator
{
  public function getButtonToAction($actionName, $params, $pk_link = false)
  {
    $params   = (array) $params;
    $options  = isset($params['params']) ? sfToolkit::stringToArray($params['params']) : array();
    $method   = 'button_to';
    $li_class = '';
    $only_for = isset($params['only_for']) ? $params['only_for'] : null;

    // default values
    if ($actionName[0] == '_')
    {
      $actionName     = substr($actionName, 1);
      $default_name   = strtr($actionName, '_', ' ');
      $default_icon   = sfConfig::get('sf_admin_web_dir').'/images/'.$actionName.'_icon.png';
      $default_action = $actionName;
      $default_class  = 'sf_admin_action_'.$actionName;

      if ($actionName == 'save' || $actionName == 'save_and_add')
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

        $li_class = 'float-left';

        $only_for = 'edit';
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
    $url_params = $pk_link ? '?'.$this->getPrimaryKeyUrlParams() : '\'';

    if (!isset($options['class']) && $default_class)
    {
      $options['class'] = $default_class;
    }
    else
    {
      $options['style'] = 'background: #ffc url('.$icon.') no-repeat 3px 2px';
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
      throw new sfConfigurationException(sprintf('The "only_for" parameter can only takes "create" or "edit" as argument ("%s")', $only_for));
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

      $html .= '[?php echo button_to(__(\''.$name.'\'), \'auto'.$this->getModuleName().'/'.$action.$url_params.', '.$phpOptions.') ?]';
    }

    if ($only_for !== null)
    {
      $html .= '[?php endif; ?]'."\n";
    }

    $html .= '</li>'."\n";

    return $html;
  }

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

    return '<li>[?php echo link_to(image_tag(\''.$icon.'\', array(\'alt\' => __(\''.$name.'\'), \'title\' => __(\''.$name.'\'))), \'auto'.$this->getModuleName().'/'.$action.$url_params.($options ? ', '.$phpOptions : '').') ?]</li>'."\n";
  }
  
}