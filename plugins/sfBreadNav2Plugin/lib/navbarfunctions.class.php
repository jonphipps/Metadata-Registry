<?php

/**
 * sfBreadNav form.
 *
 * @package    form
 * @subpackage sf_BreadNav
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class navbarfunctions 
{
  
public static function compressNavArray (&$navarray) {

   
    $counter = 0;
    
    $size = 0;
    
    $arrlft = array();
    $arrright = array();
    $arrvals = array();
    
    foreach($navarray as &$nav) {
      array_push($arrlft,$nav->getTreeLeft());
      array_push($arrright,$nav->getTreeRight());
      array_push($arrvals, array('page' => $nav->getPage(), 'module' => $nav->getModule(), 'action' => $nav->getAction() , 'tree_parent' => $nav->getTreeParent()));
      $size += 1;
    }          
  
   //flip arrays so they can be searched
   $fliparrlft = array_flip($arrlft); 
   $fliparrright = array_flip($arrright);
   $size = $size * 2 + 1;  
   $incrementor = 2;
   
   
  for ( $i=2; $i <= $size; $i++) {
	
	     $flag = false;
       while ($flag == false && $flag < 20000) {
                          
         if ( isset ($fliparrlft[$incrementor]) ) { $arrlft[$fliparrlft[$incrementor]]=$i; $flag=true;}
         elseif ( isset ($fliparrright[$incrementor]) ) { $arrright[$fliparrright[$incrementor]]=$i; $flag=true;}           
         $incrementor++; 
       }
       	
  }
  
  for ($i=0; $i< count($arrlft) ; $i++ ) {
    $arrvals[$i]['tree_left'] = $arrlft[$i];
    $arrvals[$i]['tree_right'] = $arrright[$i];    
  }
     
	
	return $arrvals;
}

  

public static function getCredentialCriteria ($credentials, $credroles) {

  $c = new Criteria();

  if ( $credroles['superadmin']) {
    $c->add(sfBreadNavPeer::TREE_LEFT, 1 , Criteria::NOT_EQUAL);
    return $c;
  }
  
   
  $cton = $c->getNewCriterion(sfBreadNavPeer::CREDENTIAL,array_pop($credentials));
    
  foreach($credentials as $credential) {
    $cton->addOr($c->getNewCriterion(sfBreadNavPeer::CREDENTIAL,$credential));
  }
  
  //filter out root node
  $c->add(sfBreadNavPeer::TREE_LEFT, 1 , Criteria::NOT_EQUAL);
  //filter by user credentials
  $c->addOr($cton);
  return $c;  
}

public static function pageroute ($module, $action) {
  
  $concat = $module;
  if (strlen($action) > 0) {$concat = $module . '/' . $action;} 
  return $concat;
  
}

public static function testforchildren (&$pages, $i) {
  if( $pages[$i]['tree_right'] > $pages[$i]['tree_left'] + 1){return true;}else{return false;}
}
  
}
