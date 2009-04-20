<?php

function link_to_remote_pane_file($text, $filename = null, $update = 'feedback', $html_options = '')
{
  $anchor = '';
  if(count($fileparts = split('#', $filename)) > 1)
  {
    $filename = $fileparts[0];
    $anchor = $fileparts[1];
  }
  return link_to_remote($text, array(
      'url'      => 'sfControlPanel/showFile?filename='.rawurlencode(str_replace(array('\\', '.'), array('/', '%%'), ($filename ? $filename : $text))), 
      'update'   => $update,
      'loading'  => "Element.addClassName(document.getElementsByTagName('html')[0], 'waiting');",
      'success'  => "Element.removeClassName(document.getElementsByTagName('html')[0], 'waiting');",
      'complete' => $anchor ? "$('main').scrollTop = $('".trim($anchor)."').offsetTop - (document.all ? 5 : 100);" : "",
    ), $html_options);
}

function link_to_remote_pane($text, $url, $update = 'feedback', $html_options = '')
{
  return link_to_remote($text, array(
      'url'     => $url, 
      'update'  => $update,
      'loading' => "Element.addClassName(document.getElementsByTagName('html')[0], 'waiting');",
      'success' => "Element.removeClassName(document.getElementsByTagName('html')[0], 'waiting');",
    ), $html_options);
}

function link_to_toggle($text, $element)
{
  return link_to_function($text, visual_effect('toggle_blind', $element, array('duration' => 0.5)));  
}

function lcfirst($name)
{
  $first_letter = strtolower(substr($name, 0, 1));

  return $first_letter.substr($name, 1, strlen($name)-1);
}

function link_to_file($path, $name = null)
{
  return link_to(($name === null ? $path : $name), 'sfControlPanel/fileBrowser?filename='.rawurlencode(str_replace(array('\\', '.'), array('/', '%%'), $path)));
}
