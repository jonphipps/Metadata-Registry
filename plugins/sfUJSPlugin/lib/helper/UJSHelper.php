<?php

use_javascript('/sfUJSPlugin/js/jquery');

/**
 * Inserts JavaScript code unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS("alert('foobar');") ?>
 * </code>
 *
 * @param  string JavaScript code
 */
function UJS($script)
{
  $response = sfContext::getInstance()->getResponse();
  $response->setParameter('script', $response->getParameter('script', '', 'symfony/view/UJS').$script.";\n", 'symfony/view/UJS');
}

/**
 * Starts a JavaScript code block for unobstrusive insertion
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_block() ?>
 *    alert('foobar');
 *  <?php UJS_end_block() ?> 
 * </code>
 *
 * @see UJS_end_block
 */
function UJS_block()
{
  ob_start();
  ob_implicit_flush(0);
}

/**
 * Ends a JavaScript code block and inserts the JavaScript code unobstrusively
 *
 * @see UJS_block
 */
function UJS_end_block()
{
  $content = ob_get_clean();
  UJS($content);
}

/**
 * Gets a template-unique ID
 *
 * @return integer the incremental ID
 */
 function UJS_incremental_id()
{
  static $ujs_incremental_id = 0;
  return 'UJS_'.$ujs_incremental_id++;
}

/**
 * Inserts an invisible placeholder for adding something to the DOM with UJS afterwards
 *
 * @param string the id attribute of the placeholder
 *
 * @return string an HTML <span> tag 
 */
function UJS_placeholder($id)
{
  return content_tag('span', '', array('style' => 'display: none', 'class' => 'UJS_placeholder', 'id' => $id));
}

/**
 * Replaces an existing DOM element with some content unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_replace('#foo', '<div>Hello, world!</div>') ?>
 * </code>
 *
 * @param string the CSS3 selector to the DOM element(s) to replace
 * @param string the HTML content to use for replacement
 *
 */
function UJS_replace($selector, $html_code)
{
  $html_code = preg_replace('/\r\n|\n|\r/', "\\n", $html_code);
  $html_code = preg_replace("/'/", "\'", $html_code);
  UJS(sprintf("\$('%s').after('%s');\$('%s').remove()", $selector, $html_code, $selector));
}

/**
 * Adds some some content unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_write('<div>Hello, world!</div>') ?>
 * </code>
 *
 * @param string the HTML content to use for insertion
 *
 */
function UJS_write($html)
{
  $id = UJS_incremental_id();
  UJS_replace("#".$id, $html);
  echo UJS_placeholder($id);
}

/**
 * Starts a HTML code block for unobstrusive content insertion
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_write_block() ?>
 *    <div>Hello, world!</div>
 *  <?php UJS_end_write_block() ?> 
 * </code>
 *
 * @see UJS_end_write_block
 */
function UJS_write_block()
{
  ob_start();
  ob_implicit_flush(0);  
}

/**
 * Ends a HTML code block for unobstrusive content insertion
 *
 * @see UJS_write_block
 */
function UJS_end_write_block()
{
  $content = ob_get_clean();
  UJS_write($content);
}

/**
 * Changes some attributes of an existing DOM element unobstrusively
 * Alias for UJS_attr()
 *
 * @see UJS_attr
 */
function UJS_change_attributes($selector, $html_options = array())
{
	return UJS_attr($selector, $html_options);
}

/**
 * Changes some attributes of an existing DOM element unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_attr('#foo', array('class' => 'bar', 'alt' => 'foobar')) ?>
 *  // You can also use the string syntax
 *  <?php UJS_attr('#foo', 'class=bar alt=foobar') ?>
 * </code>
 *
 * @param string the CSS3 selector to the DOM element(s) to replace
 * @param array the element attributes to update
 */
function UJS_attr($selector, $html_options = array())
{
  $html_options = _parse_attributes($html_options);
  $response = sfContext::getInstance()->getResponse();
  $script = $response->getParameter('script', '', 'symfony/view/UJS');
  $attributes = '';
  foreach($html_options as $key => $value)
  {
    $attributes .= sprintf(".attr('%s', '%s')", $key, $value);
  }
  $script .= sprintf("\$('%s')%s;\n", $selector, $attributes);
  $response->setParameter('script', $script, 'symfony/view/UJS');
}

/**
 * Changes some style attributes of an existing DOM element unobstrusively
 * Alias for UJS_css()
 *
 * @see UJS_css
 */
function UJS_change_style($selector, $css_options = array())
{
	return UJS_css($selector, $css_options);
}

/**
 * Changes some style attributes of an existing DOM element unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_attr('#foo', array('display' => 'none', 'text-decoration' => 'underline')) ?>
 *  // You can also use the string syntax
 *  <?php UJS_attr('#foo', 'display:none text-decoration:underline') ?>
 * </code>
 *
 * @param string the CSS3 selector to the DOM element(s) to replace
 * @param array the style attributes to update
 */
function UJS_css($selector, $css_options = array())
{
  if(is_string($css_options))
  {
    // Fixme: allow for semicolon separator
    preg_match_all('/
      \s*([\w-]+)             # key (may contain dash)            \\1
      \s*:\s*                 # :
      (\'|")?                 # values may be included in \' or " \\2
      (.*?)                   # value                             \\3
      (?(2) \\2)              # matching \' or " if needed        \\4
      \s*(?:
        (?:[\w-]+\s*:) | \s*$  # followed by another key: or the end of the string
      )
    /x', $css_options, $matches, PREG_SET_ORDER);
    $css_options = array();
    foreach ($matches as $val)
    {
      $css_options[$val[1]] = sfToolkit::literalize($val[3]);
    }
  }

  $response = sfContext::getInstance()->getResponse();
  $script = $response->getParameter('script', '', 'symfony/view/UJS');
  $attributes = '';
  foreach($css_options as $key => $value)
  {
    $attributes .= sprintf(".css('%s', '%s')", $key, $value);
  }
  $script .= sprintf("\$('%s')%s;\n", $selector, $attributes);
  $response->setParameter('script', $script, 'symfony/view/UJS');
}

/**
 * Adds an event listener to an existing DOM element unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php UJS_add_behaviour('#foo', 'click', "alert('foobar')") ?>
 * </code>
 *
 * @param string the CSS3 selector to the DOM element(s) concerned by the behaviour
 * @param string the event name (without leading 'on')
 * @param string JavaScript code
 */
function UJS_add_behaviour($selector, $event, $script)
{
  UJS(sprintf("\$('%s').%s(function() { %s })", $selector, $event, $script));  
}

/**
 * Inserts a link triggering a script unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php echo UJS_link_to_function('click me', "alert('foo')", array('class' => 'bar')) ?>
 *  // You can also use the string syntax
 *  <?php echo UJS_link_to_function('click me', "alert('foo')", 'class=bar') ?>
 * </code>
 *
 * @param string The text displayed in the link
 * @param string JavaScript code
 * @param array the <a> element attributes
 *
 * @return string An invisible HTML placeholder 
 */
function UJS_link_to_function($name, $script, $html_options = array())
{
  $html_options = _parse_attributes($html_options);
  $html_options['href'] = isset($html_options['href']) ? $html_options['href'] : '#';
  $html_options['onclick'] = $script.'; return false;';
  return UJS_write(content_tag('a', $name, $html_options, true));
}

/**
 * Inserts a button (input type=button) triggering a script unobstrusively
 *
 * <b>Example:</b>
 * <code>
 *  <?php echo UJS_button_to_function('click me', "alert('foo')", array('class' => 'bar')) ?>
 *  // You can also use the string syntax
 *  <?php echo UJS_button_to_function('click me', "alert('foo')", 'class=bar') ?>
 * </code>
 *
 * @param string The text displayed in the button
 * @param string JavaScript code
 * @param array the <a> element attributes
 *
 * @return string An invisible HTML placeholder 
 */
function UJS_button_to_function($name, $script, $html_options = array())
{
  $html_options = _parse_attributes($html_options);
  $html_options['type'] = 'button';
  $html_options['value'] = $name;
  $html_options['onclick'] = $script;
  return UJS_write(tag('input', $html_options, false, true));
}

/**
 * Returns previously added UJS code
 *
 * @param boolean True for static code (attached in another file), false otherwise (default)
 *
 * @return string if $static=false, a JavaScript code block
 */
function get_UJS($static = false)
{
  $response = sfContext::getInstance()->getResponse();
  $response->setParameter('included', true, 'symfony/view/UJS');
  
  if ($UJS = $response->getParameter('script', false, 'symfony/view/UJS'))
  {
	  $code = sprintf("\$().ready(function(){\n%s })", $UJS);
	  if($static)
	  {
      // JavaScript code is in another file
      $key = md5(sfRouting::getInstance()->getCurrentInternalUri());
      sfContext::getInstance()->getUser()->setAttribute('UJS_'.$key, $code, 'symfony/flash');
      use_javascript(url_for('UJS/script?key='.$key).'.php');
    }
    else
    {
      // JavaScript code appears in the document
      return sprintf("<script>\n//  <![CDATA[\n%s\n//  ]]>\n</script>", $code);
    }
  }
  return '';
}

/**
 * Prints previously added UJS code
 *
 * @param boolean True for static code (attached in another file), false otherwise (default)
 *
 */
function include_UJS($static = false)
{
  echo get_UJS($static);
}
