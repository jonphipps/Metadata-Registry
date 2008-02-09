<?php

/**
 * Subclass for performing query and update operations on the 'reg_user' table.
 *
 *
 *
 * @package lib.model
 */
class UserPeer extends BaseUserPeer
{
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
  * gets an array of User objects related to a group of Agents
  *
  * The user group is defined by the agents for which the supplied userID is an admin
  * or all users if the ShowAll flag is set
  *
  * @param integer $userId The ID of the Agent Admin
  * @param boolean $showAll Show all users in the system if set to true
  * @return array An array of User objects
  */
  public static function getUsersForAgentUsers($userId = null, $showAll = false)
  {
   $con = Propel::getConnection(self::DATABASE_NAME);

   //retrieve the current UserId if none is supplied
   if (!$userId)
   {
     $userId = sfContext::getInstance()->getUser()->getSubscriberId();
   }

   $sql = "SELECT DISTINCT reg_user.* FROM " . UserPeer::TABLE_NAME;

   if (!$showAll) //we add criteria to select only users attached to the supplied $userId
   {
      $sql .= " INNER JOIN " . AgentHasUserPeer::TABLE_NAME . " ON " .  UserPeer::ID . " = " . AgentHasUserPeer::USER_ID .
              " WHERE " . AgentHasUserPeer::USER_ID . " = " . $userId;
   }

   $stmt = $con->createStatement();
   $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);

   $result = parent::populateObjects($rs);
   return $result;
  }

} // UserPeer
