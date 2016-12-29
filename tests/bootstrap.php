<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2016-12-28,  Time: 10:29 AM */

$dir = __DIR__;

include $dir . '/../bootstrap/autoload.php';
$artisan = $dir . '/../artisan';

$connection = env('DB_CONNECTION');

exec("php $artisan migrate:refresh --seed --database=$connection", $returns);
//exec("php $artisan db:seed --database=$connection", $returns);
