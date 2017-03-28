<?php
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;

// include project configuration
include SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

if (class_exists('DB')) {
  require_once $sf_symfony_lib_dir . '/config/sfConfig.class.php';
  sfConfig::set('db_phptype', DB::connection()->getConfig("driver"));
  sfConfig::set('db_host', DB::connection()->getConfig("host"));
  sfConfig::set('db_port', DB::connection()->getConfig("port"));
  sfConfig::set('db_database', DB::connection()->getConfig("database"));
  sfConfig::set('db_username', DB::connection()->getConfig("username"));
  sfConfig::set('db_password', DB::connection()->getConfig("password"));
  sfConfig::set('db_encoding', DB::connection()->getConfig("charset"));
}

//override the symfony database settings with current Laravel

// symfony bootstraping
require_once $sf_symfony_lib_dir . '/util/sfCore.class.php';
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);
