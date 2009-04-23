<?php

/**
 * feedHelper
 * http://spindrop.us/2006/07/04/dynamic-linking-to-syndication-feeds-with-symfony/
 *
 * @author Dave Dash 
 */

function include_feeds()
{
  $type = 'rss';
  $already_seen = array();
  foreach (sfContext::getInstance()->getRequest()->getAttribute('helper/asset/auto/feed', array()) as $files)
  {
    if (!is_array($files))
    {
      $files = array($files);
    }
    foreach ($files as $file)
    {
      if (isset($already_seen[$file])) continue;
      $already_seen[$file] = 1;
      echo tag('link', array('rel' => 'alternate', 'type' => 'application/'.$type.'+xml', 'title' => ucfirst($type), 'href' => url_for($file, true)));
    }
  }
}

