<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) 2004 David Heinemeier Hansson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * TagHelper defines some base helpers to construct html tags.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     David Heinemeier Hansson
 * @version    SVN: $Id: TagHelper.php 3336 2007-01-23 21:05:10Z fabien $
 */

/**
 * Constructs an html tag.
 *
 * @param  $name    string  tag name
 * @param  $options array   tag options
 * @param  $open    boolean true to leave tag open
 * @return string
 */
function tag($name, $options = array(), $open = false, $raw = false)
{
  if (!$name)
  {
    return '';
  }

  return '<'.$name._tag_options($options, $raw).(($open) ? '>' : ' />');
}

function content_tag($name, $content = '', $options = array(), $raw = false)
{
  if (!$name)
  {
    return '';
  }

  return '<'.$name._tag_options($options, $raw).'>'.$content.'</'.$name.'>';
}

function cdata_section($content)
{
  return "<![CDATA[$content]]>";
}

/**
 * Escape carrier returns and single and double quotes for Javascript segments.
 */
function escape_javascript($javascript = '')
{
  $javascript = preg_replace('/\r\n|\n|\r/', "\\n", $javascript);
  $javascript = preg_replace('/(["\'])/', '\\\\\1', $javascript);

  return $javascript;
}

/**
 * Escapes an HTML string.
 *
 * @param  string HTML string to escape
 * @return string escaped string
 */
function escape_once($html)
{
  return fix_double_escape(htmlspecialchars($html));
}

/**
 * Fixes double escaped strings.
 *
 * @param  string HTML string to fix
 * @return string escaped string
 */
function fix_double_escape($escaped)
{
  return preg_replace('/&amp;([a-z]+|(#\d+)|(#x[\da-f]+));/i', '&$1;', $escaped);
}

function _tag_options($options = array(), $raw = false)
{
  static $sf_incremental_id = 0;
  $options = _parse_attributes($options);
  $response = sfContext::getInstance()->getResponse();
  $script = $response->getParameter('script', '', 'symfony/view/UJS');
  $html = '';
  $id = isset($options['id']) ? $options['id'] : false;
  foreach ($options as $key => $value)
  {
    if(strpos($key, 'on') !== 0 || $raw)
    {
      // regular attribute
      $html .= ' '.$key.'="'.escape_once($value).'"';
    }
    else
    {
      // event handler
      if(!$id)
      {
        $id = UJS_incremental_id();
        $html .= ' id="'.$id.'"';
      }
      use_javascript('/sfUJSPlugin/js/jquery');
      if(is_array($value))
      {
        $behaviour = array();
        foreach($value as $behaviour_single)
        {
          $behaviour[] = "function() { ".escape_once($behaviour_single)." }";
        }
        $behaviour = implode(' ,', $behaviour);
      }
      else
      {
        $behaviour = "function() { ".escape_once($value)." }";
      }
      $script .= "$('#".$id."').".
                     substr($key, 2, strlen($key) - 2).
                     "( ".$behaviour." );\n";
    }
    $response->setParameter('script', $script, 'symfony/view/UJS');
  }

  return $html;
}

function _parse_attributes($string)
{
  return is_array($string) ? $string : sfToolkit::stringToArray($string);
}

function _get_option(&$options, $name, $default = null)
{
  if (array_key_exists($name, $options))
  {
    $value = $options[$name];
    unset($options[$name]);
  }
  else
  {
    $value = $default;
  }

  return $value;
}
