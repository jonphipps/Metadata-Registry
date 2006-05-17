<?php

  // include base peer class
  require_once 'model/om/BaseAgentHasUserPeer.php';
  
  // include object class
  include_once 'model/AgentHasUser.php';


/**
 * Skeleton subclass for performing query and update operations on the 'reg_agent_has_user' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class AgentHasUserPeer extends BaseAgentHasUserPeer {
  public function getAgentCount($userId) {
    $criteria = new Criteria();
  	$criteria->add(AgentHasUserPeer::USER_ID, $userId);
    $AgentCount = $this->doCount($criteria);
    return $AgentCount;
  }

} // AgentHasUserPeer