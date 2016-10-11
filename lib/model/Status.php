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
   * @return string
   */
   public function __toString()
   {
     return $this->getDisplayName();
   }

} // Status
