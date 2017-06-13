<?php
// Here you can initialize variables that will be available to your tests

$dir = __DIR__;

if (file_exists(dirname(__DIR__) . '/.env.testing')) {
    (new \Dotenv\Dotenv(dirname(__DIR__), '.env.testing'))->load();
}

include $dir . '/../bootstrap/autoload.php';
$artisan = $dir . '/../artisan';

//$connection = env('DB_CONNECTION');

//exec("php $artisan migrate:refresh --seed --database=$connection", $returns);
