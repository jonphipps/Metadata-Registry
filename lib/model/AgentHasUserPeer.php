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

   /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function doSelectForCurrentUser()
  {
      $con = Propel::getConnection(self::DATABASE_NAME);
      $criteria = self::getCurrentUserCriteria();
      $result = self::doSelect($criteria, $con);
      return $result;
  }

   /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function doSelectForUser($userId)
  {
      $criteria = new Criteria(self::DATABASE_NAME);
      $criteria->add(self::USER_ID, $userId);
      $con = Propel::getConnection(self::DATABASE_NAME);
      $result = self::doSelect($criteria, $con);
      return $result;
  }

  /**
  * description
  *
  * @return return_type
  */
  public static function doCountForCurrentUser()
  {
      $criteria = self::getCurrentUserCriteria();
      $result = self::doCount($criteria);
      return $result;
  }

  /**
  * gets the criteria for select based on whether the user is an admin
  *
  * @return criteria object
  */
  public static function getCurrentUserCriteria()
  {
      $criteria = new Criteria(self::DATABASE_NAME);
      $user = sfContext::getInstance()->getUser();
      $userId = $user->getSubscriberId();
      $isAdmin = $user->hasCredential(array (0 => 'administrator' ));
      if (!$isAdmin)
      {
         $criteria->add(self::USER_ID, $userId);
      }
    return $criteria;
  }

} // AgentHasUserPeer
