<?php

/**
 * Subclass for representing a row from the 'reg_agent_has_user' table.
 *
 *
 *
 * @package lib.model
 */
class AgentHasUser extends BaseAgentHasUser
{
  /**
  * overrides the parent save function
  *
  */
  public function save($con = null)
  {
    $saved = parent::save();

    //update the credentials
    /** @var sfUser **/
    $user = sfContext::getInstance()->getUser();
    $userId = $user->getAttribute('subscriber_id','','subscriber');
    $agentUser = $this->getUserId();

    if ($saved && $agentUser == $userId)
    {
      $user->setAgentCredentials();
    }

    return $saved;
  }
} // AgentHasUser
