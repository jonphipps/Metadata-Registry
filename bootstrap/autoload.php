<?php
define('ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so that we do not have to worry about the
| loading of any our classes "manually". Feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Include The Compiled Class File
|--------------------------------------------------------------------------
|
| To dramatically increase your application's performance, you may use a
| compiled class file which contains all of the classes commonly used
| by a request. The Artisan "optimize" is used to create this file.
|
*/

$compiledPath = __DIR__.'/cache/compiled.php';

if (file_exists($compiledPath)) {
    require $compiledPath;
}

/*
 * Setup bugsnag and set the correct favicon
 */

$dotenv = new Dotenv\Dotenv(ROOT_DIR);
$dotenv->load();
$bugsnagStage = env('BUGSNAG_RELEASE_STAGE', '');
/** @var Bugsnag\Configuration $bugsnag */
$bugsnag = Bugsnag\Client::make(env('BUGSNAG_API_KEY'));
$bugsnag->setReleaseStage($bugsnagStage);
$bugsnag->setErrorReportingLevel(E_ALL & ~E_NOTICE);

if (array_key_exists('HTTP_HOST', $_SERVER)) {
  Bugsnag\Handler::register($bugsnag);
  switch ($_SERVER['HTTP_HOST']) {
    case 'registry.dev':
      if ( ! $bugsnagStage) {
        $bugsnag->setReleaseStage('development');
      }
      $icon = 'registry_favicon_dev.ico';
      break;
    case 'beta.metadataregistry.net':
    case 'beta.metadataregistry.org':
    case 'beta-sand.metadataregistry.org':
    case 'beta-prod.metadataregistry.org':
      if ( ! $bugsnagStage) {
        $bugsnag->setReleaseStage('beta');
      }
      $icon = 'registry_favicon_beta.ico';
      break;
    case 'sandbox.metadataregistry.org':
      if ( ! $bugsnagStage) {
        $bugsnag->setReleaseStage('sandbox');
      }
      $icon = 'registry_favicon_sand.ico';
      break;
    default:
      if ( ! $bugsnagStage) {
        $bugsnag->setReleaseStage('production');
      }
      $icon = 'registry_favicon_prod.ico';
  }
  putenv("FAVICON=$icon");
  $releaseStage = empty(env('BUGSNAG_NOTIFY_RELEASE_STAGES')) ? ['production'] : explode(',',
      str_replace(' ', '', env('BUGSNAG_NOTIFY_RELEASE_STAGES')));
  $bugsnag->setNotifyReleaseStages($releaseStage);
}
