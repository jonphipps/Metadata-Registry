<?php
// Here you can initialize variables that will be available to your tests
use Codeception\Util\Fixtures;
Fixtures::add('importFolder', getcwd().'/tests/_data/');

if ( ! defined('SF_APP')) {
    define('SF_APP', 'frontend');
    define('SF_ENVIRONMENT',  'dev');
    define('SF_DEBUG', 'true');
}
if ( ! defined('SF_ROOT_DIR')) {
    define('SF_ROOT_DIR', getcwd().'/');
}
/** @noinspection PhpIncludeInspection */
require_once SF_ROOT_DIR . 'apps/frontend/config/config.php';

//make sure we have a fresh instance since it's never an internal symfony forward
if (sfContext::hasInstance()) {
    sfContext::removeInstance();
}

return sfContext::getInstance();

