<?php

define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));

//initialize composer through laravel bootstrap
require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'bootstrap/autoload.php';

//fire up Laravel
$app = require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'bootstrap/app.php';

//we may use this in future to prescreen URLs to bypass laravel processing
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

/** @var \Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

//let laravel handle the response
$response = $kernel->handle($request = Illuminate\Http\Request::capture());
if ($response->getStatusCode() !== 418) {
  $response->send();

  $kernel->terminate($request, $response);

} else {
  //it's not a route that laravel recognizes
  //so we fire up symfony
  define('SF_APP', 'frontend');
  define('SF_ENVIRONMENT', env('SF_ENVIRONMENT', 'prod'));
  define('SF_DEBUG', env('SF_DEBUG', 'false'));

  require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

  sfContext::getInstance()->getController()->dispatch();
}
