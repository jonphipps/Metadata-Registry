<?php
  
  $credArray = array();
  $credRoles = array();
  
  $user = sfContext::getInstance()->getUser();
  $authenticated = $user->isAuthenticated();
  
  if ($authenticated) {
    if ($user->isSuperAdmin()) {
      $credRoles['superadmin'] = true;
      
    }else {
      $credArray = $user->getAllPermissionNames();
      array_push($credArray,'authenticated');    
      $credRoles['superadmin'] = false;
    }
  }else{
    $credRoles['superadmin'] = false;
    array_push($credArray,'unauthenticated');
  }
  array_push($credArray,''); 
 
include_partial('sfBreadNav/navmenu_show', array('menu' => $menu, 'credArray' => $credArray,'credRoles' => $credRoles)); 

?>