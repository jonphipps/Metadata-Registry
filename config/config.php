<?php
// This directory contains a mix of symfony and laravel config files.
// This is one of only two non-laravel files.
// So if no symfony bootstrap settings, then we skip it.
if ( ! defined('SF_ROOT_DIR') && $_SERVER['SCRIPT_NAME'] != 'symfony') {
  return;
}

// symfony directories
$sf_symfony_lib_dir  = dirname(__FILE__) . '/../lib/symfony';
$sf_symfony_data_dir = dirname(__FILE__) . '/../data/symfony';
