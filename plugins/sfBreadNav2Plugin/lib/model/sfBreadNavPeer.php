<?php
class sfBreadNavPeer extends BasesfBreadNavNestedSetPeer
{

  public static function getRoot($scope) {
    $c = new Criteria();

    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
      $c->addJoin(sfBreadNavPeer::SCOPE, sfBreadNavApplicationPeer::ID);
    }
     
    $c->add (self::SCOPE,$scope);
    $c->add (self::TREE_LEFT, 1);
     
    return self::doSelectOne($c);
  }
  
  public static function getMenuRoot($menu) {
    $c = new Criteria();
    $c->add (self::TREE_LEFT, 1);
    $c->add(sfBreadNavApplicationPeer::NAME, $menu);
    $c->addJoin(sfBreadNavPeer::SCOPE, sfBreadNavApplicationPeer::ID);
    return self::doSelectOne($c);
  }

  public static function saveHome($values, $scope) {
    //if home does not exist create it
    //else  update home
    if (self::scopeowner($scope)) {
      
    
    $root = self::getRoot($scope);
    if ($root) {
      
      $root->setPage($values['page']);
      $root->setModule($values['module']);
      $root->setAction($values['action']);
      $root->setCredential($values['credential']);
      $root->setCatchall( ( isset($values['catch_all'])) ? 1 : null)  ;
      $root->save();
      return true;
    }else{
      $root = new sfBreadNav();
      $root->makeRoot();
      $root->setPage($values['page']);
      $root->setModule($values['module']);
      $root->setAction($values['action']);
      $root->setCredential($values['credential']);
      $root->setCatchall( ( isset($values['catch_all'])) ? 1 : null)  ;
      $root->setScope($scope);
      $root->save();
      return true;
    }
    }else{
      return false;
    }
  }
  
  public static function addPage($values, $scope) {
    
    if (self::scopeowner($scope)) {
    
    $parent = sfBreadNavPeer::retrieveByPK($values['parent']);
    $sibling = sfBreadNavPeer::retrieveByPK($values['order']);
    $beforeorafter = $values['order_option'];
    if(isset($values['catch_all'])){$catchall = $values['catch_all'];}else{ $catchall = null;}
    
    $newpage = new sfBreadNav();
       
    $newpage->setPage($values['page']);
    $newpage->setModule($values['module']);
    $newpage->setAction($values['action']);
    $newpage->setCredential($values['credential']);
    $newpage->setCatchall($catchall);
    $newpage->setScope($scope);
   
    
    if($sibling) {
      if($beforeorafter == 'above'){$newpage->insertAsPrevSiblingOf($sibling); $newpage->save();  }
      if($beforeorafter == 'below'){$newpage->insertAsNextSiblingOf($sibling); $newpage->save();  }      
    }else {    
      //if parent not set  parent to root
      if (!$parent) {$parent = self::getRoot($scope);} 
        $newpage->insertAsLastChildOf($parent); 
        $newpage->save();
    }
    return true;
    
    }else{
      return false;
    }
        
  }
  
  public static function editPage($values) {
    
    if (self::pageowner($values['id'])) { 
    
    $parent = sfBreadNavPeer::retrieveByPK($values['parent']);
    $sibling = sfBreadNavPeer::retrieveByPK($values['order']);
    $beforeorafter = $values['order_option'];
        
    $newpage = sfBreadNavPeer::retrieveByPK($values['id']); 
            
    $newpage->setPage($values['page']);
    $newpage->setModule($values['module']);
    $newpage->setAction($values['action']);
    $newpage->setCredential($values['credential']);
    if (!isset($values['catch_all'])) {$values['catch_all'] = null;}
    $newpage->setCatchall($values['catch_all']);
    
    
    if($sibling) {
      if($beforeorafter == 'above'){$newpage->moveToPrevSiblingOf($sibling); $newpage->save();  }
      if($beforeorafter == 'below'){$newpage->moveToNextSiblingOf($sibling); $newpage->save();  }      
    }elseif ($parent){
      $newpage->moveToLastChildOf($parent);
    }
    $newpage->save();
    return true;
    }else{
    return false;
    }
    
  }
  
  public static function getParentArray($scope) {
    
    $parentarray = array(-1 => '');
    $c = new Criteria();
    $c->add (self::SCOPE,$scope);
    $c->addAscendingOrderByColumn(self::TREE_LEFT);
    $pages = self::doSelect($c);
    
    foreach ($pages as $page) {  
      $parentarray[$page->getId()] = $page->getPage();
    }
    
    return $parentarray;
  
  }

  public static function getOrderArray($scope) {
    
    $orderarray = array(-1 => '');
    $c = new Criteria();
    $c->add(self::TREE_LEFT, 1 , Criteria::NOT_EQUAL);
    $c->add (self::SCOPE,$scope);
    $c->addAscendingOrderByColumn(self::TREE_LEFT);
    $pages = self::doSelect($c);
    
    foreach ($pages as $page) {  
      $orderarray[$page->getId()] = $page->getPage();
    }
    
    return $orderarray;
  
  }
  
  public static function scopeowner($scope) {
    
    //if config set to ownermenu only show users menus
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c = new Criteria();
      $c->add(sfBreadNavApplicationPeer::ID,$scope);
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
      $result = sfBreadNavApplicationPeer::doCount($c);
      if ($result > 0) {return true;}else {return false;}  
    }else{
      return true;
    }
          
  }
  
  public static  function pageowner($pageid) {
    
    //if config set to ownermenu only show users menus
    if (sfConfig::get('app_sfBreadNav_UserMenus',false)) {
      $c = new Criteria();
      $c->add (sfBreadNavPeer::ID,$pageid);
      $c->add(sfBreadNavApplicationPeer::USER_ID,sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
      $result = sfBreadNavPeer::doCountJoinsfBreadNavApplication($c);
      if ($result > 0) {return true;}else {return false;}  
    }else{
      return true;
    }
          
  }
  
}
