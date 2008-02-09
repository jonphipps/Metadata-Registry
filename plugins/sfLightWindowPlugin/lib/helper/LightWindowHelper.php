<?php
/*
  width		      // Width of window
  height		    // Height of window
  show_images	  // Number of images to show at once in a gallery, by default its 1, but this can be handy for say a Before and After Gallery
  top			      // Set as an Integer to be spaced from the Top
  left		      // Set as an Integer to be spaced from the Left
  type		      // Specify the type the window should be treated as i.e. page, external, image, media, inline
  loading_animation	// Set to false to opt to not fade out the Loading Cover
  iframe_embed  // To embed media into a media into an iframe rather than just into a div
  form 		      // The name of the form
*/
function lw_link($name = '', $internal_uri = '', $options = array())
{
  list($lw_options, $html_options) = _lwSplitOptions(_parse_attributes($options));
  
  if (isset($lw_options['lwAddResources'])) {
    $lw_options['lwAddResources'] ? _lwAddResources() : null;
    unset($lw_options['lwAddResources']);
  } else {
    _lwAddResources();
  }
    
  if (isset($lw_options['lw_class'])) {
    $lw_class = $lw_options['lw_class'];
    unset($lw_options['lw_class']);
  } else {
    $lw_class = 'lightwindow';
  }

  if (isset($html_options['class'])) {
    $html_options['class'] .= ' ' . $lw_class;
  } else {
    $html_options['class'] = $lw_class;
  }
  
  if (!empty($lw_options)) {
    $params = array();
    foreach ($lw_options as $option => $value) {
      $params[] = 'lightwindow_'.$option.'='.$value;
    }
    
    $html_options['params'] = implode(',', $params);
  }
  
  if ($internal_uri[0] == '#') {
    $html_options['href'] = $internal_uri;
    return content_tag('a', $name, $html_options);
  }
    
  return link_to($name, $internal_uri, $html_options);
}

function lw_image($name = '', $image_path = '', $options = array())
{
  if (strpos($image_path, '://') === false) {
    return lw_link($name, image_path($image_path, true), $options);
  } else {
    return lw_link($name, $image_path, $options);
  }
}

function lw_media($name = '', $path = '', $options = array())
{
  return lw_link($name, _compute_public_path($path, '', '', true), $options);
}
    
function lw_gallery($images, $gallery_name, $options = array())
{
  _lwAddResources();
  $options = _parse_attributes($options);
  $html = '';

  if (isset($options['hide'])) {
    $make_hidden = (boolean) $options['hide'];
    unset($options['hide']);
  } else {
    $make_hidden = true;
  }
  $start_hiding = false;
  foreach ($images as $image) {
    $image_options = isset($image['options']) ? _parse_attributes($image['options']) : array();
    $image_options['rel'] = $gallery_name;
    foreach ($options as $k => $v) {
      if (!isset($image_options[$k])) {
        $image_options[$k] = $v;
      }
    }
    if ($make_hidden && $start_hiding) {
      $image_options['class'] = 'lightwindow_hidden';
    }
    $html .= lw_image($image['link'], $image['src'], $image_options)."\n";
    $start_hiding = true;
  }
  
  return $html;
}

function lw_close($name = 'close', $options = array())
{
  _lwAddResources();
  $options = _parse_attributes($options);
  $options['lw_class'] = 'lightwindow_action';
  $options['rel'] = 'deactivate';
  
  return lw_link($name, '#', $options);
}

function lw_form_submit($name = '<button>Submit</button>', $action = '', $options = array())
{
  _lwAddResources();
  $options = _parse_attributes($options);
  $options['lw_class'] = 'lightwindow_action';
  $options['rel'] = 'submitForm';
  $options['type'] = 'page';
  
  return lw_link($name, $action, $options);
}

function lw_form_cancel($name = 'cancel', $options = array())
{
  _lwAddResources();
  $options = _parse_attributes($options);
  $options['lw_class'] = 'lightwindow_action';
  $options['rel'] = 'submitForm';
  
  return lw_link($name, '#', $options);
}

// will only work if iframe does NOT include lightwindow.js
function lw_iframe_link($name = '', $path = '', $options = array()) 
{
  static $is_included = false;
  if (!$is_included) {
    $response = sfContext::getInstance()->getResponse();
    $response->addJavascript(sfConfig::get('sf_lightwindow_prototype_dir'). 'prototype.js');
  }
  $options = _parse_attributes($options);
  $options['lw_class'] = 'lightwindow_iframe_link';
  $options['lwAddResources'] = false;
  
  return lw_link($name, $path, $options);
}

function lw_iframe_js()
{
  $js = "
   var links = $$('.lightwindow_iframe_link');
  	links.each(function(link) {
  		Event.observe(link, 'click', function() {parent.myLightWindow.activate(null, link);}, false);
  		link.onclick = function() {return false;};
  });";
  
  return $js;
}
		
function lw_button($name = '', $link = '', $js_options = array(), $html_options = array())
{
  _lwAddResources();
  $js_options   = _parse_attributes($js_options);
  $html_options = _parse_attributes($html_options);
  
  $js_options['href']     = url_for($link);
  $html_options['value']  = $name;
  $html_options['type']   = 'button';
  $html_options['onclick']= _lwButtonJs($js_options);

  return tag('input', $html_options);
}
/*
<?php echo lw_button('Launch it from this button!', 'http://stickmanlabs.com/images/kevin_vegas.jpg', 'title="waiting for the show to start in Las Vegas" author="Jazzmatt" caption="Mmmmm Margaritas! And yes, this is me..." left=300') ?>
<input type="button" onclick="javascript: " value="Launch it from this Button!" />
*/
function _lwAddResources()
{
  static $is_included = false;
  if (!$is_included) {
    $response = sfContext::getInstance()->getResponse();
    $response->addJavascript(sfConfig::get('sf_lightwindow_prototype_dir'). 'prototype.js');
    $response->addJavascript(sfConfig::get('sf_lightwindow_prototype_dir'). 'effects.js');

    $response->addJavascript(sfConfig::get('sf_lightwindow_js_dir'). 'lightwindow.js');
    $response->addStylesheet(sfConfig::get('sf_lightwindow_css_dir'). 'lightwindow.css');
    $is_included = true;
  }
}

function _lwSplitOptions($options = array())
{
  $html_keys    = array('class', 'style', 'title', 'author', 'caption', 'rel', 'absolute', 'query_string');
  $html_options = array();
  $lw_options   = array();
  
  foreach ($options as $k => $v) {
    if (in_array($k, $html_keys)) {
      $html_options[$k] = $v;
    } else {
      $lw_options[$k] = $v;
    }
  }
  
  return array($lw_options, $html_options);
}

function _lwButtonJs($options = array())
{
  $js_options = array();
  foreach ($options as $k => $v) {
    $js_options[] = "$k: '".escape_javascript($v)."'";
  }
  
  $js = 'myLightWindow.activateWindow({'.implode(', ',$js_options).'}); return false;';
  
  return $js;
}

?>