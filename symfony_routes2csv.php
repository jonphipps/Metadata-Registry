<?php

include __DIR__ . '/vendor/autoload.php';
$routes = unserialize(file_get_contents(__DIR__ . '/symfony_routes.php'), [true]);
$list[] = '"url","route name","module","action","tabnav"';
foreach ($routes as $key => $route) {
    $list[] = implode(',', ['"' . $route['url'] . '"',
        '"' . $key . '"',
        '"' . ($route['param']['module'] ?? '') . '"',
        '"' . ((strpos($key, '_resource') !== false) ? 'RESOURCE' : $route['param']['action'] ?? '') . '"',
        '"' . ($route['param']['tabnav'] ?? '') . '"', ]);
}
file_put_contents(__DIR__ . '/symfony_routes.csv', implode("\n", $list));
