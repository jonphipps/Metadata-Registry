<?php

  use_helper('Javascript');

/*
 * This file is part of the symfony package.
 * (c) 2006 Dmitry Parnas <parnas@rock.zp.ua>
 * (c) 2006 Dustin Whittle <dustin.whittle@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony.runtime.addon
 * @subpackage helper
 * @author     Dmitry Parnas <parnas@rock.zp.ua>
 * @author     Dustin Whittle <dustin.whittle@symfony-project.com>
 * @version    SVN: $Id$
 */

  $request = sfContext::getInstance()->getResponse();
  $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/prototype');
  $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/scriptaculous');
  $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/effects');
  $request->addJavascript(sfConfig::get('sf_prototype_web_dir').'/tooltip');

  /**
   * Builds open div tag ready with inforamtion for tooltip.js
   *
   * Example:
   * <code>
   *   <?php echo tooltip_div('my_element_id', 'css_class_for_it', array('style' => 'visibility: hidden')) ?>
   * </code>
   *
   * @param string HTML id of the element this tooltip is for
   * @param css_class CSS class to skin tooltip in (if not default)
   * @param array Other attributes for the tag. You can also pass string suitable for _parse_attributes()
   *
   * @return string An HTML div string
   *
   */
  function tooltip_div($element_id, $css_class = '', $options = array())
  {
    $options = _parse_attributes($options);
    $options['class'] = $css_class.' tooltip for_'.$element_id;

    return tag('div', $options, true);
  }

  /**
   * Builds script that sets optional settings for tooltips on the page.
   *
   * Example:
   * <code>
   *   <?php echo tooltips_js('autoMoveToCursor=false showEvent=click', 'appear=true blindDown=true', 'blindUp=true', array('style.position' => 'absolute'), array('style.position' => 'absolute')) ?>
   * </code>
   *
   * @param array Tooltip.js settings. You can also pass string suitable for _parse_attributes()
   * @param array Ordered list of script.aculo.us effects you want to apply during tooltip show process. You can also pass string suitable for _parse_attributes()
   * @param array Ordered list of script.aculo.us effects you want to apply during tooltip hide process. You can also pass string suitable for _parse_attributes()
   * @param array Other settings for tooltip show process. You can also pass string suitable for _parse_attributes()
   * @param array Other settings for tooltip hide process. You can also pass string suitable for _parse_attributes()
   *
   * @return string An HTML script string.
   *
   */

  function tooltips_js($options = array(), $show_effects = array(), $hide_effects = array(), $show_options = array(), $hide_options = array())
  {
    $options      = _parse_attributes($options);
    $show_effects = _parse_attributes($show_effects);
    $hide_effects = _parse_attributes($hide_effects);
    $show_options = _parse_attributes($show_options);
    $hide_options = _parse_attributes($hide_options);

    $code = '';
    foreach($options as $key => $value)
    {
      $value = _method_option_to_s($value);
      $value = (is_bool($value)) ? ($value === false) ? 'false' : 'true' : $value;
      $code .= '  Tooltip.'.$key.' = '.$value."\n";
    }
    $code .= _build_functions('show', $show_effects, $show_options);
    $code .= _build_functions('hide', $hide_effects, $hide_options);

    return javascript_tag($code);
  }


  function _build_functions($type, $effects = array(), $options = array())
  {
    $code = '';

    if($effects)
    {
      $code .= '  Tooltip.'.$type.'Method = function (tooltip, options)'."\n";
      $code .= '  {'."\n";

      foreach($effects as $key => $value)
      {
        $code .= 'Effect.'.ucfirst($key).'(tooltip, options)'."\n";
      }

      if($options)
      {
        foreach($options as $key => $value)
        {
          $value = _method_option_to_s($value);
          $value = (is_bool($value)) ? ($value === false) ? 'false' : 'true' : $value;
          $code .= '    tooltip.'.$key.' = '.$value."\n";
        }
      }
      $code .= '  }'."\n";

      return $code;
    }

}

?>