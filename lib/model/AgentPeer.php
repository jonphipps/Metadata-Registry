<?php

/**
 * Subclass for performing query and update operations on the 'reg_agent' table.
 *
 *
 *
 * @package lib.model
 */
class AgentPeer extends BaseAgentPeer
{
  /**
  * gets an array of Agent objects related to a user
  *
  * @return Agent
  */
  public static function getAgentsForCurrentUser()
  {
    $isAdmin = sfContext::getInstance()->getUser()->hasCredential(array (0 => 'administrator' ));
    $c = new Criteria();
    if (!$isAdmin)
    {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $c->addJoin(AgentHasUserPeer::AGENT_ID, AgentPeer::ID);
      $c->add(AgentHasUserPeer::USER_ID,$userId);
    }
    $c->addAscendingOrderByColumn(AgentPeer::ORG_NAME);
    $result = AgentPeer::doSelect($c);
    return $result;
  }
} // AgentPeer
