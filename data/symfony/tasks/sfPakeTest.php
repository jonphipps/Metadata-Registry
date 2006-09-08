<?php

pake_desc('launch project test suite');
pake_task('test');

pake_desc('launch test suite for a plugin');
pake_task('plugin-test');

function run_test($task, $args)
{
  if (!count($args))
  {
    throw new Exception('You must provide the app to test.');
  }

  $app = $args[0];

  if (!is_dir(sfConfig::get('sf_app_dir').DIRECTORY_SEPARATOR.$app))
  {
    throw new Exception(sprintf('The app "%s" does not exist.', $app));
  }

  // define constants
  define('SF_ROOT_DIR',    getcwd());
  define('SF_APP',         $app);
  define('SF_ENVIRONMENT', 'test');
  define('SF_DEBUG',       true);

  // get configuration
  require_once SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';

  $dirs_to_test = array($app);
  if (is_dir('test/project'))
  {
    $dirs_to_test[] = 'project';
  }

  pake_import('simpletest', false);
  pakeSimpletestTask::call_simpletest($task, 'text', $dirs_to_test);
}

function run_plugin_test($task, $args)
{
  if (!count($args))
  {
    throw new Exception('You must provide the plugin to test.');
  }

  $plugin = $args[0];

  $dir = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$plugin;
  if (!is_dir($dir))
  {
    throw new Exception(sprintf('The plugin "%s" does not exist.', $plugin));
  }

  pake_import('simpletest', false);
  pakeSimpletestTask::call_simpletest($task, 'text', array($dir));
}
