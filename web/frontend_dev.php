<?php

define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
define('SF_APP', 'frontend');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG', true);

//initialize composer through laravel bootstrap
require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'bootstrap/autoload.php';

//fire up Laravel
$app = require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'bootstrap/app.php';
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
/** @var \Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle($request = Illuminate\Http\Request::capture());
if ($response->getContent() !== "symfony") {
  $response->send();
  $kernel->terminate($request, $response);
} else {

  require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

  sfContext::getInstance()->getController()->dispatch();
}
