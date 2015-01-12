<?php
// This is global bootstrap for autoloading
use Codeception\Configuration;

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/../'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'test');
define('SF_DEBUG',       isset($debug) ? $debug : true);
//load dotenv
if (file_exists(SF_ROOT_DIR.'/tests/.env'))
{
    Dotenv::load(SF_ROOT_DIR.'/tests');
}
//initialize composer
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php');
// initialize symfony
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
// initialize database manager
$databaseManager = new \sfDatabaseManager();
$databaseManager->initialize();
