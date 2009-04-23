<?php
$request = sfContext::getInstance()->getRequest();
$action = $request->getParameter('action');
$module = $request->getParameter('module');
include_partial('sfBreadNav/breadcrumb_show', array('menu' => $menu, 'module' => $module, 'action' => $action));
?>