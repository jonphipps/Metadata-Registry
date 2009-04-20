<?php

/**
 * Subclass for representing a row from the 'reg_skos_property' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SkosProperty extends BaseSkosProperty
{
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
