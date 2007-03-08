<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// we need sqlite for functional tests
if (!extension_loaded('SQLite'))
{
  return false;
}
//debugbreak();

define('SF_ROOT_DIR',    realpath(dirname(__FILE__).sprintf('/../%s/fixtures/project', isset($type) ? $type : 'functional')));
define('SF_APP',         $app);
define('SF_ENVIRONMENT', 'test');
define('SF_DEBUG',       isset($debug) ? $debug : true);

debugbreak();

// initialize symfony
$_test_dir = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..');
include($_test_dir.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// include project configuration
include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

if (SF_APP)
{
  // include application configuration
  include(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
}
else
{
  // symfony bootstraping
  require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
  sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);
}


// remove all cache
sfToolkit::clearDirectory(sfConfig::get('sf_cache_dir'));

if (isset($fixtures))
{
  // initialize database manager
  $databaseManager = new sfDatabaseManager();
  $databaseManager->initialize();

  // cleanup database
  $db = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'/database.sqlite';
  if (file_exists($db))
  {
    unlink($db);
  }

  // initialize database
  $sql = file_get_contents(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.'lib.model.schema.sql');
  $sql = preg_replace('/^\s*\-\-.+$/m', '', $sql);
  $sql = preg_replace('/^\s*DROP TABLE .+?$/m', '', $sql);
  $con = Propel::getConnection();
  $tables = preg_split('/CREATE TABLE/', $sql);
  foreach ($tables as $table)
  {
    $table = trim($table);
    if (!$table)
    {
      continue;
    }

    $con->executeQuery('CREATE TABLE '.$table);
  }

  // load fixtures
  $data = new sfPropelData();
  if (is_array($fixtures))
  {
    $data->loadDataFromArray($fixtures);
  }
  else
  {
    $data->loadData(sfConfig::get('sf_data_dir').'/'.$fixtures);
  }
}

return true;
