<?php
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;

// include project configuration
include SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

// symfony bootstraping
require_once $sf_symfony_lib_dir . '/util/sfCore.class.php';
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);
