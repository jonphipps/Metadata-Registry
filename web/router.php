<?php
/**
 * Created by PhpStorm.
 * User: jonphipps
 * Date: 2016-09-29
 * Time: 11:16 AM
 */


// router for php built in server to show directory listings.
// php -S localhost:8001 router.php

$path = $_SERVER['DOCUMENT_ROOT'] . $_SERVER["REQUEST_URI"];
$uri  = $_SERVER["REQUEST_URI"];

// let server handle files or 404s
if ( ! file_exists($path) || is_file($path)) {
  return false;
}

// send index.html and index.php
$indexes = [ 'frontend_dev.php, frontend.php'];
foreach ($indexes as $index) {
  $file = $path . '/' . $index;
  if (is_file($file)) {
    return require( $file );
  }
}
