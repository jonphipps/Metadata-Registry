<?php

  use_helper('Javascript');

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Dustin Whittle <dustin.whittle@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony.runtime.addon
 * @author     Dustin Whittle <dustin.whittle@symfony-project.com>
 * @version    SVN: $Id$
 */

  /**
   * link_to_prototype_dialog creates a dialog box using prototype.
   *
   *
   * Example:
   * <code>
   *   <?php use_helper('Window'); ?>
   *   <?php if(sfConfig::get('sf_debug')) { echo link_to_function('open debug window', 'showDebug()'); } ?>
   *   <?php echo link_to_prototype_dialog('hello', 'hello world', 'alert', array('className' => 'alphacube')); ?>
   * </code>
   *
   * @link http://prototype-window.xilinus.com/documentation.html#initialize
   *
   * @param string $name
   * @param string $content
   * @param string $dialog_type 'alert' (default), 'confirm' or 'info' (info dialogs should be destroyed with a javascript function call 'win.destroy')
   * @param array $options for this helper depending the dialog_kind: http://prototype-window.xilinus.com/documentation.html#alert (#confirm or #info)
   * @param array $options_html
   * @return string
   */

  function link_to_prototype_dialog($name, $content, $dialog_type = 'alert', $window_options = array(), $options = array(), $options_html = array())
  {

    $request = sfContext::getInstance()->getResponse();
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/prototype');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/scriptaculous');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/effects');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/window');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/window_ext');

    $request->addStylesheet(sfConfig::get('sf_prototype_web_dir').'/themes/default.css');

    if(isset($window_options['className']) && ($window_options['className'] != 'default'))
    {
      $request->addStylesheet(sfConfig::get('sf_prototype_web_dir').'/themes/'.$window_options['className'].'.css');
    }

    if(sfConfig::get('sf_debug'))
    {
      $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/debug');
      $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/extended_debug');
    }

    $window_options = array_merge(array('title' => 'New Dialog', 'className' => 'dialog', 'width' => '200', 'height' => '100', 'zIndex' => '100', 'draggable' => 'true', 'resizable' => 'true', 'opacity' => 1, 'showEffect' => 'Effect.BlindDown', 'hideEffect' => 'Effect.SwitchOff'), _parse_attributes($window_options));

    if (isset($window_options['title'])) { $window_options['title'] = _method_option_to_s($window_options['title']); }
    if (isset($window_options['className'])) { $window_options['className'] = _method_option_to_s($window_options['className']); }

    $window_options = _options_for_javascript($window_options);
    $default_options = array('windowParameters' => $window_options);
    $options = _options_for_javascript(array_merge($default_options, _parse_attributes($options)));

    $js_code = 'Dialog.'.$dialog_type.'('._method_option_to_s($content).', '.$options.');';

    $options_html = _parse_attributes($options_html);

    $options_html['href'] = isset($options_html['href']) ? $options_html['href'] : '#';
    $options_html['onclick'] = isset($options_html['onclick']) ? $options_html['onclick'] . $js_code : $js_code;

    return content_tag('a', $name, $options_html);
  }

  /**
   * link_to_prototype_window creates a window using prototype.
   *
   * Example:
   * <code>
   *   <?php use_helper('Window'); ?>
   *   <?php if(sfConfig::get('sf_debug')) { echo link_to_function('open debug window', 'showDebug()'); } ?>
   *   <?php echo link_to_prototype_window('Google', 'google', array('title' => 'Google', 'url' => 'http://google.com', 'width' => '520', 'height' => '350', 'center' => 'true', 'className' => 'alphacube'), array('absolute' => true)); ?>
   *   <?php echo link_to_prototype_window('DW', 'dw', array('title' => 'DW', 'url' => '@homepage', 'width' => '520', 'height' => '350', 'center' => 'true', 'className' => 'alphacube')); ?>
   * </code>
   *
   * @link http://prototype-window.xilinus.com/documentation.html#initialize
   *
   * @param string $name
   * @param string $window_id must be unique and it's destroyed on window close.
   * @param array $options options for this helper: http://prototype-window.xilinus.com/documentation.html#initialize
   * @param array $options_html
   * @return string
   */

  function link_to_prototype_window($name, $window_id, $options, $options_html = array())
  {
    $request = sfContext::getInstance()->getResponse();
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/prototype');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/scriptaculous');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/effects');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/window');
    $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/window_ext');

    $request->addStylesheet(sfConfig::get('sf_prototype_web_dir').'/themes/default.css');

    if(isset($options['className']) && ($options['className'] != 'default'))
    {
      $request->addStylesheet(sfConfig::get('sf_prototype_web_dir').'/themes/'.$options['className'].'.css');
    }

    if(sfConfig::get('sf_debug'))
    {
      $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/debug');
      $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/extended_debug');
    }

    $options = array_merge(array('title' => 'New Window', 'className' => 'dialog', 'width' => '600', 'height' => '450', 'zIndex' => '100', 'draggable' => 'true', 'resizable' => 'true', 'opacity' => 1, 'showEffect' => 'Effect.BlindDown', 'hideEffect' => 'Effect.SwitchOff'), _parse_attributes($options));

    if (isset($options['title'])) { $options['title'] = _method_option_to_s($options['title']); }
    if (isset($options['className'])) { $options['className'] = _method_option_to_s($options['className']); }

    $absolute = isset($options_html['absolute']) ? true : false;
    unset($options_html['absolute']);

    if (isset($options['url'])) { $options['url'] = _method_option_to_s(url_for($options['url'], $absolute)); }

    $front = isset($options['front']) ? $window_id.'.toFront();' : '';
    unset($options['front']);

    $status = isset($options['status']) ? $window_id.'.setStatusBar('.$options['status'].');' : '';
    unset($options['status']);

    $show = isset($options['center']) ? $window_id.'.showCenter();' : $window_id.'.show();';
    unset($options['center']);

    $options = _options_for_javascript($options);
    $options_html = _parse_attributes($options_html);

    $js_code = 'var ' . $window_id . ' = new Window('.$window_id.', '.$options.');'.$front.$status.$show.$window_id.'.setDestroyOnClose();';

    $options_html['href'] = isset($options_html['href']) ? $options_html['href'] : '#';
    $options_html['onclick'] = isset($options_html['onclick']) ? $options_html['onclick'] . $js_code : $js_code;

    return content_tag('a', $name, $options_html);
  }

?>