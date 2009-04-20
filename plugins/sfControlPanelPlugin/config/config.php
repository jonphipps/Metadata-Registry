<?php

$module_dirs = sfConfig::get('sf_module_dirs');
$module_dirs[sfConfig::get('sf_module_cache_dir')] =  true;
sfConfig::set('sf_module_dirs', $module_dirs);
$controlPanelModules = sfFinder::type('dir')->name("*ControlPanel")->maxdepth(0)->relative()->ignore_version_control()->in(sfConfig::get('sf_module_cache_dir'));
$enabled_modules = sfConfig::get('sf_enabled_modules');
foreach($controlPanelModules as $module)
{
  $enabled_modules[] = $module;
} 
sfConfig::set('sf_enabled_modules', $enabled_modules);