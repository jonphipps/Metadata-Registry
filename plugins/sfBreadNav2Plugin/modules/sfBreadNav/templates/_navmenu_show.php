<?php
    
    $cssie56open  = '<!--[if gte IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]-->';
    $cssie56close = '<!--[if lte IE 6]></td></tr></table></a><![endif]-->';
    
    echo '<style>.spacertable{ width:100%; }</style><!--[if lte IE 6]><style>.spacertable{ width:auto; display:none; }</style><![endif]-->';
    $cssff2= '<table  class="spacertable"><tr><td></td></tr></table>';
           
    $c = navbarfunctions::getCredentialCriteria($credArray, $credRoles);
    $c->addAscendingOrderByColumn(sfBreadNavPeer::TREE_LEFT);
    $c->add(sfBreadNavApplicationPeer::NAME, $menu);
    $c->addJoin(sfBreadNavPeer::SCOPE, sfBreadNavApplicationPeer::ID);
    $pages = sfBreadNavPeer::doSelect($c);
    $pages = navbarfunctions::compressNavArray($pages);
    
    $outputArray = array();
    $root= sfBreadNavPeer::getMenuRoot($menu);
    //return if no root
    if(!$root) {return;}    
    $newlevel = true;
    
    echo "<!--[if IE 6]><div id='ie6only'><![endif]-->";
    echo "<div id='breadnavmenuHdiv' class='$menu'><ul id='breadnavul' class='$menu'>"; 
    if (in_array($root->getCredential(),$credArray  )) {
      echo "<li class='first top'>". navbardisplayfunctions::link_to_valid( $root->getPage(), $root->getModule(), $root->getAction(), array('class' => 'first top'))  ."</li>\n";
    }  
   
    $nexttop = 0;
         
    for ($i=0; $i< count($pages) ; $i++ ) {  
      
      if ($i==$nexttop) {
         $havechildren = navbarfunctions::testforchildren($pages,$i);
         $nexttop = ($pages[$i]['tree_right'] + 1) / 2 - 1; 
         
         if ($havechildren){
           $open = "<li class='breadnavdivider'>". '<a class=top href=' . navbardisplayfunctions::url_for_valid(navbarfunctions::pageroute($pages[$i]['module'],$pages[$i]['action'])) . ">" . $pages[$i]['page'] . $cssie56open."<ul>";
           $close = '</ul>' . $cssie56close ."</li>\n";
         }else{
           $open = "<li class='breadnavdivider'>". '<a class=top href=' . navbardisplayfunctions::url_for_valid(navbarfunctions::pageroute($pages[$i]['module'],$pages[$i]['action'])) . ">" . $pages[$i]['page'] . $cssie56open;
           $close = $cssie56close ."</li>\n";
         }
      
      //no children   
      }elseif ($pages[$i]['tree_right'] - $pages[$i]['tree_left'] == 1) {                 
           $open = "<li class='standard' >"  . '<a class=standard href=' . navbardisplayfunctions::url_for_valid(navbarfunctions::pageroute($pages[$i]['module'],$pages[$i]['action'])) . ">" . $pages[$i]['page'] . '</a>'.$cssff2;
           $close = "</li>\n";         
      //has children                 
      }else{
    
          $open = "<li class='standard'>" . '<a class=standard href=' . navbardisplayfunctions::url_for_valid(navbarfunctions::pageroute($pages[$i]['module'],$pages[$i]['action'])) . ">"  . $pages[$i]['page'] . $cssie56open   . $cssff2 . "<ul>";
          $close =  "</ul>". $cssie56close ."</li>\n";
                 
      }
       
      $outputArray[$pages[$i]['tree_left']]  = $open;
      $outputArray[$pages[$i]['tree_right']] = $close;                      
    }
      
    //perform output    
    $size = count($outputArray);
    ksort($outputArray);
        
    foreach ($outputArray as $output) {
      echo $output;
    }    
    echo "</ul></div>";
    echo "<!--[if IE 6]>  </div>  <![endif]-->"; 
    //echo "<div style='clear: both;'></div>";
