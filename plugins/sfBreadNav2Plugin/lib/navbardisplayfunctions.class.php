<?php

/**
 * sfBreadNav form.
 *
 * @package    form
 * @subpackage sf_BreadNav
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class navbardisplayfunctions 
{
  

public static function link_to_valid($page, $module, $action, $options) {

try {
 $link =   link_to($page , navbarfunctions::pageroute($module,$action), $options);    
} catch (Exception $e) {
 $link =   link_to($page , "http://routenotfound" , $options);  
}
 return $link;
}

 
public static function url_for_valid($path) {

try {
 $link =   url_for($path);    
} catch (Exception $e) {
 $link =   "http://routenotfound";  
}
 return $link;
}  

  
}
