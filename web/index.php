<?php
if ($foo) {
  require __DIR__ . '/../bootstrap/autoload.php';
  $app = require_once __DIR__ . '/../bootstrap/app.php';

  /** @var \Illuminate\Contracts\Http\Kernel $kernel */
  $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

  $response = $kernel->handle($request = Illuminate\Http\Request::capture());

  $response->send();

  $kernel->terminate($request, $response);

} else {
  define('SF_ROOT_DIR', realpath(dirname(__FILE__) . '/..'));
  define('SF_APP', 'frontend');
  define('SF_ENVIRONMENT', 'prod');
  define('SF_DEBUG', false);

  require_once SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'apps' . DIRECTORY_SEPARATOR . SF_APP . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

  sfContext::getInstance()->getController()->dispatch();
}
