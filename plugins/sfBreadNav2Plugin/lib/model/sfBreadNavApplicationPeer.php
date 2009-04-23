<?php

class sfBreadNavApplicationPeer extends BasesfBreadNavApplicationPeer
{
  
  public static function getScopeArray() {
    
    $scopearray = array();
    $c = new Criteria();
    
    //if config set to ownermenu only show users menus
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));  
    }
        
    $c->addAscendingOrderByColumn(sfBreadNavApplicationPeer::ID);
    $menus = self::doSelect($c);
    
    foreach ($menus as $menu) {  
      $scopearray[$menu->getId()] = $menu->getName();
    }
    
    return $scopearray;
  
  }
  
}
