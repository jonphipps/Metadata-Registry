<?php

/**
 * Subclass for performing query and update operations on the 'reg_agent_has_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AgentHasUserPeer extends BaseAgentHasUserPeer
{
  public function getAgentCount($userId) {
    $criteria = new Criteria();
  	$criteria->add(AgentHasUserPeer::USER_ID, $userId);
    $AgentCount = $this->doCount($criteria);
    return $AgentCount;
  }

} // AgentHasUserPeer
