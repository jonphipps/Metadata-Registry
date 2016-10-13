<?php
// include project configuration
include( SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php' );

// symfony bootstraping
require_once( $sf_symfony_lib_dir . '/util/sfCore.class.php' );
sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

//initialize composer through laravel bootstrap
require SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'bootstrap/autoload.php';

$dotenv = new Dotenv\Dotenv(SF_ROOT_DIR);
$dotenv->load();
/** @var Bugsnag $bugsnag */
$bugsnag = Bugsnag\Client::make(env('BUGSNAG_API_KEY'));
$bugsnag->setReleaseStage(env('BUGSNAG_RELEASE_STAGE', 'production'));

if (array_key_exists('SERVER_NAME', $_SERVER)) {
  Bugsnag\Handler::register($bugsnag);
  switch ($_SERVER['SERVER_NAME']) {
    case 'registry.dev':
    case 'beta.metadataregistry.net':
      $bugsnag->setReleaseStage('development');
      $icon = 'registry_favicon_dev.ico';
      break;
    case 'beta.metadataregistry.org':
    case 'beta-sand.metadataregistry.org':
    case 'beta-prod.metadataregistry.org':
      $bugsnag->setReleaseStage('beta');
      $icon = 'registry_favicon_beta.ico';
      break;
    case 'sandbox.metadataregistry.org':
      $bugsnag->setReleaseStage('sandbox');
      $icon = 'registry_favicon_sand.ico';
      break;
    default:
      $bugsnag->setReleaseStage('production');
      $icon = 'registry_favicon_prod.ico';
  }
  putenv("FAVICON=$icon");
}
