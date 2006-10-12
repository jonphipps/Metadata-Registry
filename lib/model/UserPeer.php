<?php

  // include base peer class
  require_once 'model/om/BaseUserPeer.php';
  
  // include object class
  include_once 'model/User.php';


/**
 * Skeleton subclass for performing query and update operations on the 'reg_user' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class UserPeer extends BaseUserPeer {
  public static function getUserFromNickname($nickname)
  {
    $c = new Criteria();
    $c->add(self::NICKNAME, $nickname);

    return self::doSelectOne($c);
  }

  public static function getAuthenticatedUser($nickname, $password)
  {
    $user = self::getUserFromNickname($nickname);

    // nickname exists?
    if ($user)
    {
      // password is OK?
      $shaiPass = sha1($user->getSalt().$password);
      if ($shaiPass == $user->getSha1Password())
      {
        return $user;
      }
    }

    return null;
  }

  public static function getModeratorCandidatesCount()
  {
    $c = new Criteria();
    $c->add(self::WANT_TO_BE_MODERATOR, true);

    return self::doCount($c);
  }

  public static function getModeratorCandidates()
  {
    $c = new Criteria();
    $c->add(self::WANT_TO_BE_MODERATOR, true);
    $c->addAscendingOrderByColumn(self::CREATED_AT);

    return self::doSelect($c);
  }

  public static function getModerators()
  {
    $c = new Criteria();
    $c->add(self::IS_MODERATOR, true);
    $c->addAscendingOrderByColumn(self::CREATED_AT);

    return self::doSelect($c);
  }

  public static function getAdministrators()
  {
    $c = new Criteria();
    $c->add(self::IS_ADMINISTRATOR, true);
    $c->addAscendingOrderByColumn(self::CREATED_AT);

    return self::doSelect($c);
  }

  public static function getProblematicUsersCount()
  {
    $c = new Criteria();
    $c->add(self::DELETIONS, 0, Criteria::GREATER_THAN);

    return self::doCount($c);
  }

  public static function getProblematicUsers()
  {
    $c = new Criteria();
    $c->add(self::DELETIONS, 0, Criteria::GREATER_THAN);
    $c->addDescendingOrderByColumn(self::DELETIONS);

    return self::doSelect($c);
  }
  
  public static function getUsersCount()
  {
    $c = new Criteria();

    return self::doCount($c);
  }

  /**
  * 
  * gets an array of User objects related to a group of Agents
  * The user group is defined by the agents for which the user is an admin
  * or all users if the user is a sysem admin
  *
  * @return Agent
  */
  public static function getUsersForAgentUsers()
  {
   $con = Propel::getConnection(self::DATABASE_NAME);  
   $isAdmin = sfContext::getInstance()->getUser()->hasCredential(array (0 => 'administrator' ));
   $sql = "SELECT DISTINCT * FROM " . UserPeer::TABLE_NAME;
   if (!$isAdmin)
   {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $sql .= " INNER JOIN " . AgentHasUserPeer::TABLE_NAME . " ON " .  UserPeer::ID . " = " . AgentHasUserPeer::USER_ID .
              " WHERE " . AgentHasUserPeer::USER_ID . " = " . $userId;
   }
    
   $stmt = $con->createStatement();
   $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);
    
   $result =  parent::populateObjects($rs);   
   return $result;
  }

} // UserPeer