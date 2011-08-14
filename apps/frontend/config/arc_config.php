<?php
// include project configuration
require(dirname(__FILE__).'/config.php');
require($sf_symfony_lib_dir.'/../arc/ARC2.php'); // path to the file ARC2.php
$database = $this->getContext()->getDatabaseManager()->getDatabase('propel')->getConfiguration();
$connection = $database['propel']['datasources']['propel']['connection'];

// SQL database configuration for storing the postings:
$arc_config = array(
  /* MySQL database settings */
  'db_host' => $connection['hostspec'],
  'db_user' => $connection['username'],
  'db_pwd' => $connection['password'],
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