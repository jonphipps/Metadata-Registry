<?php

/**
 * Subclass for performing query and update operations on the 'users' table.
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
  * @param user $user The current user object
  * @param boolean $showAll Show all users in the system if set to true
  * @return array An array of User objects
  */
  public static function getUsersForAgentUsers(User $user = null, $showAll = false)
  {
   $con = Propel::getConnection(self::DATABASE_NAME);

   //retrieve the current UserId if none is supplied
   if (!$user)
   {
     $userId = sfContext::getInstance()->getUser()->getSubscriberId();
   }
   else
   {
     $userId = $user->getId();
   }

   $sql = "SELECT DISTINCT users.* FROM " . UserPeer::TABLE_NAME;

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

    /**
  * gets an array of User objects NOT related to the current agent
  *
  * The user group is defined by removing users already related to the supplied agentId
  *
  * @param Agent $agent The current agent
  * @return array An array of User objects
  */
  public static function getNewUsersForAgent($criteria)
  {
      $curUsers = [];
      $agentId = null;

      $agent      = sfContext::getInstance()->getUser()->getAttribute('agent', '');
      $vocabulary = sfContext::getInstance()
                             ->getUser()
                             ->getAttribute('vocabulary', '', 'symfony/user/sfUser/attributes');
      if ($agent) {
          $agentId = $agent->getId();
      } else {
          if ( ! empty( $vocabulary )) {
              $agentId = $vocabulary->getAgentId();
          } else {
              $vocabId = sfContext::getInstance()->getRequest()->getParameter('vocabulary_id');
              if ( ! empty( $vocabId )) {
                  $vocabulary = VocabularyPeer::retrieveByPK($vocabId);
                  $agentId    = $vocabulary->getAgentId();
              }
          }
      }
      if ($agentId) {
          //get the current user list for this agent
          $c = new Criteria();
          $c->add(AgentHasUserPeer::AGENT_ID, $agentId);

          $curUsers = AgentHasUserPeer::doSelect($c);
      }

      $c = new Criteria();
      $c->addAscendingOrderByColumn(self::NICKNAME);

      $newUsers = UserPeer::doSelect($c);
   foreach ($curUsers as $curUser)
   {
     $curId = $curUser->getUserId();
     foreach ($newUsers as $key => $newUser)
     {
       if ($newUser->getId() == $curId)
       {
          unset($newUsers[$key]);
          break;
       }
     }
   }
   //make sure the array is contiguous
   return array_merge($newUsers);

  }

  /**
  * gets a list of users for the selected agent that have not been assigned to the current vocabulary
  *
  * @return array an array for select
  */
  public static function getNewUsersForVocabulary()
  {
    $results = array();
    $vocabulary = myActionTools::findCurrentVocabulary();
    if ($vocabulary)
    {
      //get the users for the agent
      $c = new Criteria();
      $c->addJoin(self::ID, AgentHasUserPeer::USER_ID, Criteria::LEFT_JOIN);
      $c->add(AgentHasUserPeer::AGENT_ID, $vocabulary->getAgentId(), Criteria::EQUAL);
      $c->addAscendingOrderByColumn(self::NICKNAME);
      $results = self::doSelect($c);

      //remove the current maintainers of the vocabulary
      $c = new Criteria();
      $c->add(VocabularyHasUserPeer::VOCABULARY_ID, $vocabulary->getId(), Criteria::EQUAL);
      $vocabUsers = VocabularyHasUserPeer::doSelect($c);
      /** @var $vocabUser VocabularyHasUser */
      foreach ($vocabUsers as $vocabUser)
      {
        $curId = $vocabUser->getUserId();
        /** @var $result User */
        foreach ($results as $key => $result)
        {
          if ($result->getId() == $curId)
            {
              unset($results[$key]);
              break;
            }
        }
      }
      $results = array_merge($results);
    }

    return $results;
  }

  /**
  * gets a list of users for the selected agent that have not been assigned to the current schema
  *
  * @return array an array for select
  * @param  var_type $var
  */
  public static function getNewUsersForSchema()
  {
    $schema = myActionTools::findCurrentSchema();
    $results = array();
    if ($schema)
    {
      //get the users for the agent
      $c = new Criteria();
      $c->addJoin(self::ID, AgentHasUserPeer::USER_ID, Criteria::LEFT_JOIN);
      $c->add(AgentHasUserPeer::AGENT_ID, $schema->getAgentId(), Criteria::EQUAL);
      $c->addAscendingOrderByColumn(self::NICKNAME);
      $results = self::doSelect($c);

      //remove the current maintainers of the vocabulary
      $c = new Criteria();
      $c->add(SchemaHasUserPeer::SCHEMA_ID, $schema->getId(), Criteria::EQUAL);
      $schemaUsers = SchemaHasUserPeer::doSelect($c);
      foreach ($schemaUsers as $schemaUser)
      {
        $curId = $schemaUser->getUserId();
        foreach ($results as $key => $result)
        {
          if ($result->getId() == $curId)
            {
              unset($results[$key]);
              break;
            }
        }
      }
      $results = array_merge($results);
    }

    return $results;
  }

} // UserPeer
