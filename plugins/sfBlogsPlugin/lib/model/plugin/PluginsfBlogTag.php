<?php

/**
 * Subclass for representing a row from the 'sf_blog_tag' table.
 *
 * 
 *
 * @package plugins.sfBlogsPlugin.lib.model
 */ 
class PluginsfBlogTag extends BasesfBlogTag
{
  public function __toString()
  {
    return $this->getTag();
  }
}
