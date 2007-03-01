<?php

/**
 * Subclass for representing a row from the 'reg_status' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Status extends BaseStatus
{
   /**
   * description
   *
   * @return return_type
   * @param  var_type $var
   */
   public function __toString()
   {
     return $this->getDisplayName();
   }

} // Status
