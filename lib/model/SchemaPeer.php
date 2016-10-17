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
     * @return Schema
     *
     * @param string $uri
     *
  */
  public static function  retrieveByUri($uri)
  {
		$criteria = new Criteria();
		$criteria->add(self::URI, $uri);
    $criteria->addOr(self::URI, $uri . "#");
    $criteria->addOr(self::URI, $uri . "/");

		return self::doSelectOne($criteria);

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

   return parent::populateObjects($rs);
  }

  /**
  * gets a list of all projects related to all schemas
  *
  * @return array Agents
  */
  public static function getSchemaAgents()
  {
    $results = array();
    $c = new Criteria();
    $c->clearSelectColumns();
    $c->addSelectColumn(self::AGENT_ID);
      $c->addJoin(self::AGENT_ID, AgentPeer::ID);
      $c->addAscendingOrderByColumn(AgentPeer::ORG_NAME);
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
     * @return int
     *
  * @param  integer $v Schema Id to lookup
  */
  public static function getNextSchemaPropertyId($v)
  {
    //lookup the schema
    $schema = SchemaPeer::retrieveByPK($v);
      $nextId = NULL;
      if ($schema) {
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


  /**
  * gets schema by schema URI
  *
  * @return schema
  * @param  string $schemaUri
  */
  public static function getschemaByUri($schemaUri)
  {
    $c = new Criteria();
    $c->add(self::URI, $schemaUri);

    $schema = self::doSelectOne($c);

    return $schema;

  } //getschemaByUri

  /**
  *
  * gets an array of Schema objects related to a domain
  *
     * @param string $domain
     *
     * @return Schema[]
  */
  public static function getSchemasForDomain($domain)
  {
    if (!preg_match('/%$/', $domain))
    {
      $domain .="%";
    }
    $c = new Criteria();
    $c->add(self::URI, $domain, Criteria::LIKE);
    $c->addAscendingOrderByColumn(self::NAME);
    $result = self::doSelectJoinStatus($c);

    return $result;
  }

  /**
  *
  * gets the last update, either of the schema or the history
  *
     * @param int $id
     *
     * @throws PropelException
  * @return integer
  */
  public static function getLastUpdateDate($id)
  {
    $schema = self::retrieveByPK($id);
    if ($schema)
    {
      $lastSchemaUpdate = $schema->getUpdatedAt(null);
    }
    $lastHistoryUpdate = SchemaPropertyElementHistoryPeer::getLastUpdateForSchema($id, null);
    $result = max(array($lastHistoryUpdate, $lastSchemaUpdate));

    return $result;
  }

  /**
  * gets the property count
  *
     * @param int $id
     *
  * @return integer
  */
  public static function getPropertyCount($id)
  {
    $schema = self::retrieveByPK($id);
      $result = 0;
    if ($schema)
    {
    $result = $schema->countSchemaPropertys();
    }

    return $result;
  }


}
