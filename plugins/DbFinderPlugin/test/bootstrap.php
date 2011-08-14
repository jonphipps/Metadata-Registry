<?php

// Autofind the first available app environment
$sf_root_dir = realpath(dirname(__FILE__).'/../../../');
$apps_dir = glob($sf_root_dir.'/apps/*', GLOB_ONLYDIR);
$app = substr($apps_dir[0], 
              strrpos($apps_dir[0], DIRECTORY_SEPARATOR) + 1, 
              strlen($apps_dir[0]));
if (!$app)
{
  throw new Exception('No app has been detected in this project');
}

// -- path to the symfony project where the plugin resides
$sf_path = dirname(__FILE__).'/../../..';
 
// bootstrap
include($sf_path . '/test/bootstrap/functional.php');

// create a new test browser
$browser = new sfTestBrowser();
$browser->initialize();

// initialize database manager
if(method_exists('sfDatabaseManager', 'loadConfiguration'))
{
  // symfony 1.1 style
  new sfDatabaseManager($configuration);
}
else
{
  // symfony 1.0 style
  $databaseManager = new sfDatabaseManager();
  $databaseManager->initialize();
}

define('PROPEL_VERSION', method_exists('Criteria', 'setPrimaryTableName') ? '1.3' : '1.2');
function propel_sql($sql)
{
  $regs = array('/\[P12(.+?)\]/', '/\[P13(.+?)\]/');
  if(PROPEL_VERSION == '1.2')
  {
    return preg_replace($regs, array('$1', ''), $sql);
  }
  else
  {
    return preg_replace($regs, array('', '$1'), $sql);
  }
}

function doctrine_sql($sql)
{
  $regs = array('/\[D011(.+?)\]/', '/\[D10(.+?)\]/');
  if(Doctrine::VERSION == '0.11.0')
  {
    return preg_replace($regs, array('$1', ''), $sql);
  }
  else
  {
    return preg_replace($regs, array('', '$1'), $sql);
  }
}