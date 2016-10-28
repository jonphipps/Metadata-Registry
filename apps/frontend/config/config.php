<?php
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Facade;
use Illuminate\Http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;

// include project configuration
include( SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php' );

// symfony bootstraping
require_once( $sf_symfony_lib_dir . '/util/sfCore.class.php' );
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

//initialize composer through laravel bootstrap
require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'bootstrap/autoload.php';

//initialize laravel
$container = new Container;
Container::setInstance($container);
// add the current request to the service container
Container::getInstance()->instance('request', Request::createFromGlobals());
// add the Illuminate Database Capsule
$capsule = new Capsule(Container::getInstance());
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'database',
    'username'  => 'username',
    'password'  => 'password',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
// add the Illuminate Dispatcher
$container->instance('events', new Dispatcher($container));
// add the Illuminate Hasher
$container->instance('hasher', new BcryptHasher);
Facade::setFacadeApplication($container);

// clean up the global scope
unset( $capsule, $container );

$dotenv = new Dotenv\Dotenv(SF_ROOT_DIR);
$dotenv->load();
$bugsnagStage = env('BUGSNAG_RELEASE_STAGE', '');
/** @var Bugsnag $bugsnag */
$bugsnag = Bugsnag\Client::make(env('BUGSNAG_API_KEY'));
$bugsnag->setReleaseStage($bugsnagStage);
$bugsnag->setErrorReportingLevel(E_ALL & ~E_NOTICE);

if (array_key_exists('SERVER_NAME', $_SERVER)) {
  Bugsnag\Handler::register($bugsnag);
  switch ($_SERVER['SERVER_NAME']) {
    case 'registry.dev':
      if ( ! $bugsnagStage) $bugsnag->setReleaseStage('development');
      $icon = 'registry_favicon_dev.ico';
      break;
    case 'beta.metadataregistry.net':
    case 'beta.metadataregistry.org':
    case 'beta-sand.metadataregistry.org':
    case 'beta-prod.metadataregistry.org':
      if ( ! $bugsnagStage) $bugsnag->setReleaseStage('beta');
      $icon = 'registry_favicon_beta.ico';
      break;
    case 'sandbox.metadataregistry.org':
      if ( ! $bugsnagStage) $bugsnag->setReleaseStage('sandbox');
      $icon = 'registry_favicon_sand.ico';
      break;
    default:
      if ( ! $bugsnagStage) $bugsnag->setReleaseStage('production');
      $icon = 'registry_favicon_prod.ico';
  }
  putenv("FAVICON=$icon");
  $bugsnag->setNotifyReleaseStages([ 'beta', 'sandbox', 'production' ]);

}
