<?php

require_once 'Agent.php';

require_once 'model/om/BaseAgent.php';


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'reg_agent' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Organization extends Agent {

	/**
	 * Constructs a new Organization class, setting the type column to AgentPeer::CLASSKEY_ORGANIZATION.
	 */
	public function __construct()
	{

        $this->setType(AgentPeer::CLASSKEY_ORGANIZATION);
    }

} // Organization
