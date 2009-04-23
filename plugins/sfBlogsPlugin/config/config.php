<?php 

if (in_array('sfBlog', sfConfig::get('sf_enabled_modules', array())))
{
  $this->dispatcher->connect('routing.load_configuration', array('sfBlogRouting', 'listenToRoutingLoadConfigurationEvent'));
}