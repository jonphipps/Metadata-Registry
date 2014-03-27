<?php

use_helper('Form');

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * ObjectHelper.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: ObjectHelper.php 415 2008-04-04 19:30:57Z jphipps $
 */

/**
 * Returns a html date control.
 *
 * @param object $object        An object
 * @param string $method        An object column
 * @param array  $options       Date options
 * @param bool   $default_value Date default value
 *
 * @return string An html string which represents a date control.
 */
function object_input_date_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value, $param = 'Y-m-d G:i');

  return input_date_tag(_convert_method_to_name($method, $options), $value, $options);
}

/**
 * Returns a textarea html tag.
 *
 * @param object $object        An object
 * @param string $method        An object column
 * @param array  $options       Textarea options
 * @param bool   $default_value Textarea default value
 *
 * @return string An html string which represents a textarea tag.
 */
function object_textarea_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value);

  return textarea_tag(_convert_method_to_name($method, $options), $value, $options);
}

/**
 * Accepts a container of objects, the method name to use for the value,
 * and the method name to use for the display.
 * It returns a string of option tags.
 *
 * NOTE: Only the option tags are returned, you have to wrap this call in a regular HTML select tag.
 *
 * @param array   $options      a container of objects
 * @param  string $value_method method name to use for the value
 * @param string  $text_method  method name to use for the display
 * @param string  $selected
 * @param array   $html_options
 *
 * @return string option tags
 * @throws sfViewException
 */
function objects_for_select($options = array(), $value_method, $text_method = null, $selected = null, $html_options = array())
{
  $select_options = array();
  foreach ($options as $option)
  {
    // text method exists?
    if ($text_method && !is_callable(array($option, $text_method)))
    {
      $error = sprintf('Method "%s" doesn\'t exist for object of class "%s"', $text_method, _get_class_decorated($option));
      throw new sfViewException($error);
    }

    // value method exists?
    if (!is_callable(array($option, $value_method)))
    {
      $error = sprintf('Method "%s" doesn\'t exist for object of class "%s"', $value_method, _get_class_decorated($option));
      throw new sfViewException($error);
    }

    $value = $option->$value_method();
    $key = ($text_method != null) ? $option->$text_method() : $value;

    $select_options[$value] = $key;
  }

  return options_for_select($select_options, $selected, $html_options);
}

/**
 * Returns a list html tag.
 *
 * Updated by Jon Phipps 04/12/2008
 *   added 'select_options' parameter
 *
 * @param object $object        An object or the selected value
 * @param string $method        An object column.
 * @param array  $options       Input options (related_class option is mandatory).
 * @param bool   $default_value Input default value.
 *
 * @return string A list string which represents an input tag.
 */
function object_select_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $related_class = _get_option($options, 'related_class', false);
  if (false === $related_class && preg_match('/^get(.+?)Id$/', $method, $match))
  {
    $related_class = $match[1];
  }

  $peer_method = _get_option($options, 'peer_method');

  $text_method = _get_option($options, 'text_method');

  $select_options = _get_option($options, 'select_options');
  if (!isset($select_options))
  {
    $select_options = _get_options_from_objects(sfContext::getInstance()->retrieveObjects($related_class, $peer_method), $text_method);
  }

  if ($value = _get_option($options, 'include_custom'))
  {
    $select_options = array('' => $value) + $select_options;
  }
  else if (_get_option($options, 'include_title'))
  {
    $select_options = array('' => '-- '._convert_method_to_name($method, $options).' --') + $select_options;
  }
  else if (_get_option($options, 'include_blank'))
  {
    $select_options = array('' => '') + $select_options;
  }

  if (is_object($object))
  {
    $value = _get_object_value($object, $method, $default_value);
  }
  else
  {
    $value = $object;
  }

  $option_tags = options_for_select($select_options, $value, $options);

  return select_tag(_convert_method_to_name($method, $options), $option_tags, $options);
}

function _get_options_from_objects($objects, $text_method = null)
{
  $select_options = array();

  if ($objects)
  {
    // construct select option list
    $first = true;
    foreach ($objects as $tmp_object)
    {
      if ($first)
      {
        // multi primary keys handling
        $multi_primary_keys = is_array($tmp_object->getPrimaryKey()) ? true : false;

        // which method to call?
        $methodToCall = '';
        foreach (array($text_method, '__toString', 'toString', 'getPrimaryKey') as $method)
        {
          if (is_callable(array($tmp_object, $method)))
          {
            $methodToCall = $method;
            break;
          }
        }

        $first = false;
      }

      $key   = $multi_primary_keys ? implode('/', $tmp_object->getPrimaryKey()) : $tmp_object->getPrimaryKey();
      $value = $tmp_object->$methodToCall();

      $select_options[$key] = $value;
    }
  }

  return $select_options;
}

function object_select_country_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value);

  return select_country_tag(_convert_method_to_name($method, $options), $value, $options);
}

function object_select_language_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value);
  if (isset($options['limitmethod']))
  {
    $options['languages'] = _get_object_value($object, $options['limitmethod']);
  }

  return select_language_tag(_convert_method_to_name($method, $method), $value, $options);
}

/**
 * Returns a <selectize> tag populated with all the languages in the world (or almost).
 *
 * The select_language_tag builds off the traditional select_tag function, and is conveniently populated with
 * all the languages in the world (sorted alphabetically). Each option in the list has a two or three character
 * language/culture code for its value and the language's name as its display title.  The country data is
 * retrieved via the sfCultureInfo class, which stores a wide variety of i18n and i10n settings for various
 * countries and cultures throughout the world. Here's an example of an <option> tag generated by the select_country_tag:
 *
 * <samp>
 *  <option value="en">English</option>
 * </samp>
 *
 * <b>Examples:</b>
 * <code>
 *  echo limitselect_language_tag('language', 'de');
 * </code>
 *
 * @param  string $name     field name
 * @param  string $selected selected field values (two or three-character language/culture code)
 * @param  array  $options  additional HTML compliant <select> tag parameters
 *
 * 'limitmethod' option provides a method to call that limits the list to a subset of languages
 * @return string <selectize> tag populated with all the languages in the world.
 * @see select_tag, options_for_select, sfCultureInfo
 */
function object_limitselect_language_tag($name, $selected = null, $options = array())
{
    $c = new sfCultureInfo(sfContext::getInstance()->getUser()->getCulture());
    $languages = $c->getLanguages();

    if ($language_option = _get_option($options, 'limitmethod'))
    {
        foreach ($languages as $key => $value)
        {
            if (!in_array($key, $language_option))
            {
                unset($languages[$key]);
            }
        }
    }

    asort($languages);

    $option_tags = options_for_select($languages, $selected, $options);
    unset($options['include_blank'], $options['include_custom']);

    return select_tag($name, $option_tags, $options);
}


/**
 * Returns a hidden input html tag.
 *
 * @param object $object        An object or the selected value
 * @param string $method        An object column.
 * @param array  $options       Input options.
 * @param bool   $default_value Input default value.
 *
 * @return string An html string which represents a hidden input tag.
 */
function object_input_hidden_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value);

  return input_hidden_tag(_convert_method_to_name($method, $options), $value, $options);
}

/**
 * Returns a input html tag.
 *
 * @param object $object        An object or the selected value
 * @param string $method        An object column.
 * @param array  $options       Input options.
 * @param bool   $default_value Input default value.
 *
 * @return string An html string which represents an input tag.
 */
function object_input_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $value = _get_object_value($object, $method, $default_value);

  return input_tag(_convert_method_to_name($method, $options), $value, $options);
}

/**
 * Returns a checkbox html tag.
 *
 * @param object $object        An object
 * @param string $method        An object column
 * @param array  $options       Checkbox options
 * @param bool   $default_value Checkbox default value
 *
 * @return string An html string which represents a checkbox tag.
 */
function object_checkbox_tag($object, $method, $options = array(), $default_value = null)
{
  $options = _parse_attributes($options);

  $checked = (boolean) _get_object_value($object, $method, $default_value);

  return checkbox_tag(_convert_method_to_name($method, $options), isset($options['value']) ? $options['value'] : 1, $checked, $options);
}

function _convert_method_to_name($method, &$options)
{
  $name = _get_option($options, 'control_name');

  if (!$name)
  {
    if (is_array($method))
    {
      $name = implode('-',$method[1]);
    }
    else
    {
      $name = sfInflector::underscore($method);
      $name = preg_replace('/^get_?/', '', $name);
    }
  }

  return $name;
}

// returns default_value if object value is null
// method is either a string or: array('method',array('param1','param2'))
function _get_object_value($object, $method, $default_value = null, $param = null)
{
  // compatibility with the array syntax
  if (is_string($method))
  {
    $param = ($param == null ? array() : array($param));
    $method = array($method, $param);
  }

  // method exists?
  if (!is_callable(array($object, $method[0])))
  {
    $error = 'Method "%s" doesn\'t exist for object of class "%s"';
    $error = sprintf($error, $method[0], _get_class_decorated($object));

    throw new sfViewException($error);
  }

  $object_value = call_user_func_array(array($object, $method[0]), $method[1]);

  return ($default_value !== null && $object_value === null) ? $default_value : $object_value;
}

/**
 * Returns the name of the class of an decorated object
 *
 * @param object $object An object that might be wrapped in an sfOutputEscaperObjectDecorator(-derivative)
 *
  * @return string The name of the class of the object being decorated for escaping, or the class of the object if it isn't decorated
 */
function _get_class_decorated($object)
{
  if ($object instanceof sfOutputEscaperObjectDecorator)
  {
    return sprintf('%s (decorated with %s)', get_class($object->getRawValue()), get_class($object));
  }
  else
  {
    return get_class($object);
  }
}
