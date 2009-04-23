<?php 

//get action and module
$c = new Criteria();
$c->add(sfBreadNavPeer::MODULE, $module);
$c->add(sfBreadNavPeer::ACTION, $action);
$c->add(sfBreadNavApplicationPeer::NAME, $menu);
$c->addJoin(sfBreadNavPeer::SCOPE, sfBreadNavApplicationPeer::ID);
$page = sfBreadNavPeer::doSelectOne($c);

if (!$page) {
//page not found attempting to use catchall path  
$c = new Criteria();
$c->add(sfBreadNavPeer::MODULE, $module);
$c->add(sfBreadNavPeer::CATCHALL, 0);
$c->add(sfBreadNavApplicationPeer::NAME, $menu);
$c->addJoin(sfBreadNavPeer::SCOPE, sfBreadNavApplicationPeer::ID);
$page = sfBreadNavPeer::doSelectOne($c);  
}

if ($page) {$path = $page->getPath();
  $id = $page->getId();
  foreach ($path as $node) {
    if ($node->getId() != $id){
      echo link_to($node->getPage() , $node->getModule() . '/' . $node->getAction()) . '&nbsp;&nbsp;>>&nbsp;&nbsp;';
      }
  }

}  

if ($page) {echo $page->getPage();}
else { 
  $root = sfBreadNavPeer::getMenuRoot($menu);
  if ($root) {
    echo link_to ($root->getPage(), $root->getModule() . '/' . $root->getAction());
  } 
}

?>