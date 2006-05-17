<?php

require_once '';

require_once 'model/om/BaseLookup.php';


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'reg_lookup' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Status extends Lookup {

	/**
	 * Constructs a new Status class, setting the type_id column to LookupPeer::CLASSKEY_1.
	 */
	public function __construct()
	{

        $this->setTypeId(LookupPeer::CLASSKEY_1);
    }

} // Status
