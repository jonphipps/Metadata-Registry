<?php

// Default values
$config = array(
  'connection'     => 'propel'
);

// Check custom project values in my_project/config/sfCommentPlugin.yml
if(is_readable($config_file = sfConfig::get('sf_config_dir').'/sfPropelActAsCommentableBehaviorPlugin.yml'))
{
  $user_config = sfYaml::load($config_file);
  if(isset($user_config['schema']))
  {
    $config = array_merge($config, $user_config['schema']);
  }
}