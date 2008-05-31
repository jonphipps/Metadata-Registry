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
   $con = Propel::getConnection(self::DATABASE_NAME);
   $isAdmin = sfContext::getInstance()->getUser()->hasCredential(array (0 => 'administrator' ));
   $sql = "SELECT * FROM " . AgentPeer::TABLE_NAME;
   if (!$isAdmin)
   {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $sql .= " INNER JOIN " . AgentHasUserPeer::TABLE_NAME . " ON " . AgentPeer::ID . " = " . AgentHasUserPeer::AGENT_ID .
              " WHERE " . AgentHasUserPeer::USER_ID . " = " . $userId;
   }

   $sql .= " ORDER BY " . AgentPeer::ORG_NAME ;
   $stmt = $con->createStatement();
   $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);

   $result =  parent::populateObjects($rs);
   return $result;
  }
} // AgentPeer
