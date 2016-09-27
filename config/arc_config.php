<?php

if (php_sapi_name() == "cli") {
  return;
}

if ($_SERVER['SERVER_NAME'] == 'registry')
{
  define('SF_ENVIRONMENT', 'prod');
}
elseif ($_SERVER['SERVER_NAME'] == 'beta.metadataregistry.org' || $_SERVER['SERVER_NAME'] == 'beta-sand.metadataregistry.org' || $_SERVER['SERVER_NAME'] == 'beta-prod.metadataregistry.org')
{
  define('SF_ENVIRONMENT', 'beta');
}
elseif ($_SERVER['SERVER_NAME'] == 'sandbox.metadataregistry.org')
{
  define('SF_ENVIRONMENT', 'sandbox');
}
else
{
  define('SF_ENVIRONMENT', 'prod');
}

//setup environment
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'frontend');
define('SF_DEBUG',       false);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// symfony bootstraping
require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();
$database = $databaseManager->getDatabase('propel')->getConfiguration();
$connection = $database['propel']['datasources']['propel']['connection'];

// SQL database configuration for storing the postings:
$arc_config = array(
  /* MySQL database settings */
  'db_host' => $connection['hostspec'],
  'db_user' => $connection['username'],
  'db_pwd'  => $connection['password'],
  'db_name' => $connection['database'],

  /* ARC2 store settings */
  'store_name' => 'arc',

  /* SPARQL endpoint settings */
  'endpoint_features' => array(
    'select', 'construct', 'ask', 'describe', // allow read
  ),
  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  'endpoint_read_key' => '', /* optional */
  'endpoint_write_key' => '', /* optional */
  'endpoint_max_limit' => 250, /* optional */
);
//  /* SPARQL endpoint settings */
//  'endpoint_features' => array(
//    'select', 'construct', 'ask', 'describe', // allow read
//    'load', 'insert', 'delete',               // allow update
//    'dump'                                    // allow backup
//  ),
//  'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
//  'endpoint_read_key' => '', /* optional */
//  'endpoint_write_key' => '', /* optional */
//  'endpoint_max_limit' => 250, /* optional */
//);
