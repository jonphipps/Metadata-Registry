<?php
// This is global bootstrap for autoloading
if ( ! defined('SF_APP')) {
    define('SF_APP', 'frontend');
    define('SF_ENVIRONMENT', 'test');
    define('SF_DEBUG', isset($debug) ? $debug : true);
}
if ( ! defined('SF_ROOT_DIR')) {
    define('SF_ROOT_DIR', getcwd() . '/');
}
//initialize composer
/** @noinspection PhpIncludeInspection */
require_once SF_ROOT_DIR . 'vendor/autoload.php';
/** @noinspection PhpIncludeInspection */
require_once SF_ROOT_DIR . 'apps/frontend/config/config.php';

// initialize database manager
$databaseManager = new \sfDatabaseManager();
$databaseManager->initialize();
