<?php


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'reg_resource' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package lib.model
 */	
class Schema extends Resource {

	/**
	 * Constructs a new Schema class, setting the type column to ResourcePeer::CLASSKEY_1.
	 */
	public function __construct()
	{

        $this->setType(ResourcePeer::CLASSKEY_1);
    }

} // Schema
