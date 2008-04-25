<?php

/**
 * Subclass for performing query and update operations on the 'reg_schema' table.
 *
 *
 *
 * @package lib.model
 */
class SchemaPeer extends BaseSchemaPeer
{

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function  retrieveByUri($uri)
  {
		$con = Propel::getConnection(self::DATABASE_NAME);

		$criteria = new Criteria(SchemaPeer::DATABASE_NAME);

		$criteria->add(SchemaPeer::URI, $uri);

		$v = SchemaPeer::doSelect($criteria, $con);

      return !empty($v) > 0 ? $v[0] : null;
  }

  /**
  *
  * gets an array of Schema objects related to a user
  *
  * @return Agent
  */
  public static function getSchemasForCurrentUser()
  {
   $con = Propel::getConnection(self::DATABASE_NAME);
   $isAdmin = sfContext::getInstance()->getUser()->hasCredential(array (0 => 'administrator' ));
   $sql = "SELECT DISTINCT * FROM " . SchemaPeer::TABLE_NAME;
   if (!$isAdmin)
   {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $sql .= " INNER JOIN " . AgentHasUserPeer::TABLE_NAME . " ON " .  SchemaPeer::AGENT_ID . " = " . AgentHasUserPeer::AGENT_ID .
              " WHERE " . AgentHasUserPeer::USER_ID . " = " . $userId;
   }

   $stmt = $con->createStatement();
   $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);

   $result =  parent::populateObjects($rs);
   return $result;
  }

  /**
  * gets a list of all agents related to all schemas
  *
  * @return array Agents
  * @param  var_type $var
  */
  public static function getSchemaAgents()
  {
    $results = array();
    $c = new Criteria();
    $c->clearSelectColumns();
    $c->addSelectColumn(self::AGENT_ID);
    $c->setDistinct();
    $rs = self::doSelectRS($c);
    while($rs->next())
    {
      $results[] = AgentPeer::retrieveByPK($rs->getInt(1));
    }
    return $results;
  }

  /**
  * description
  *
  * @return return_type
  * @param  integer $v Schema Id to lookup
  */
  public static function getNextSchemaPropertyId($v)
  {
    //lookup the schema
    $schema = SchemaPeer::retrieveByPK($v);
    if ($schema)
    {
      //get the last id
      $lastId = $schema->getLastUriId();
      //increment it by one and set the last_id
      $nextId = ($lastId) ? ++$lastId : 100000;
      //we should theoretically set this when we save the property, but it doesn't matter
      $schema->setLastUriId($nextId);
      $schema->save();
      return $nextId;
    }
  }

  /**
  * alias for profile fields
  *
  * @return array The fields
  */
  public static function getProfileFields()
  {
    return Schema::getProfileFields();
  }

}