<?php
// Here you can initialize variables that will be available to your tests

$dir = __DIR__;

include $dir . '/../bootstrap/autoload.php';
$artisan = $dir . '/../artisan';

$connection = env('DB_CONNECTION');

//exec("php $artisan migrate:refresh --seed --database=$connection", $returns);
