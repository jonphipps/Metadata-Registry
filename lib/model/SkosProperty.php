<?php

require_once 'model/om/BaseSkosProperty.php';


/**
 * Skeleton subclass for representing a row from the 'reg_skos_property' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class SkosProperty extends BaseSkosProperty {

  public function __toString()
  {
    return $this->getSkosProperty();
  }

  public function getSkosProperty()
  {
    return $this->getName();
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  static public function getPrefLabelId()
  {
    //TODO: This is clearly not the best way to do this
    return '19';
  }

} // SkosProperty