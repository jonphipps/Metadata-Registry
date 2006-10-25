<?php

require_once 'model/om/BaseAgent.php';


/**
 * Skeleton subclass for representing a row from the 'reg_agent' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Agent extends BaseAgent {

  public function __toString() {

    return $this->getAgent();
  }

  public function getAgent() {

    return $this->getOrgName();
  }

  public function getCountryName() {

    return format_country($this->getCountry());
  }

  public function save($con = null)
  {
    $con = Propel::getConnection();
    try
    {
      $con->begin();

      $ret = parent::save($con);

      // update agent_has_user table
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $agentId = $this->getId();
      $mode = sfContext::getInstance()->getRequest()->getParameter('action');

      //see if there's already an entry in the table and if not, add it
      $criteria = new Criteria();
			$criteria->add(AgentHasUserPeer::USER_ID, $userId);
      $AgentHasUsersColl = $this->getAgentHasUsers($criteria, $con);
      if (!count($AgentHasUsersColl))
      {
        $agentUser = new AgentHasUser();
        $agentUser->setAgentId($agentId);
        $agentUser->setUserId($userId);
        $agentUser->save($con);
      }

      $con->commit();

      sfContext::getInstance()->getUser()->setHasAgents();

      return $ret;

    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

} // Agent