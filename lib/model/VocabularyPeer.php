<?php

/**
 * Subclass for performing query and update operations on the 'reg_vocabulary' table.
 *
 *
 *
 * @package lib.model
 */
class VocabularyPeer extends BaseVocabularyPeer
{
  /**
  * description
  *
  * @return return_type
  * @param  integer $v Vocbaulary Id to lookup
  */
  public static function getNextConceptId($v)
  {
    //lookup the vocabulary
    $vocabulary = VocabularyPeer::retrieveByPK($v);
    if ($vocabulary)
    {
      //get the last id
      $lastId = $vocabulary->getLastUriId();
      //increment it by one and set the last_id
      $nextId = ($lastId) ? ++$lastId : 100000;
      //we should theoretically set this when we save the concept, but it doesn't matter
      $vocabulary->setLastUriId($nextId);
      $vocabulary->save();
      return $nextId;
    }
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function  retrieveByUri($uri)
  {
		$con = Propel::getConnection(self::DATABASE_NAME);

		$criteria = new Criteria(VocabularyPeer::DATABASE_NAME);
		$criteria->add(self::URI, $uri);
    $criteria->addOr(self::URI, $uri . "#");
    $criteria->addOr(self::URI, $uri . "/");

		$v = VocabularyPeer::doSelect($criteria, $con);

      return !empty($v) > 0 ? $v[0] : null;
  }

  /**
  *
  * gets an array of Vocabulary objects related to a user
  *
  * @return Agent
  */
  public static function getVocabulariesForCurrentUser()
  {
   $con = Propel::getConnection(self::DATABASE_NAME);
   $isAdmin = sfContext::getInstance()->getUser()->hasCredential(array (0 => 'administrator' ));
   $sql = "SELECT DISTINCT * FROM " . VocabularyPeer::TABLE_NAME;
   if (!$isAdmin)
   {
      $userId = sfContext::getInstance()->getUser()->getSubscriberId();
      $sql .= " INNER JOIN " . AgentHasUserPeer::TABLE_NAME . " ON " .  VocabularyPeer::AGENT_ID . " = " . AgentHasUserPeer::AGENT_ID .
              " WHERE " . AgentHasUserPeer::USER_ID . " = " . $userId;
   }

   $stmt = $con->createStatement();
   $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);

   $result =  parent::populateObjects($rs);
   return $result;
  }

  /**
  * gets vocabulary by vocabulary URI
  *
  * @return Vocabulary
  * @param  string $vocabUri
  */
  public static function getVocabularyByUri($vocabUri)
  {
    $c = new Criteria();
    $c->add(self::URI, $vocabUri);

    $vocab = self::doSelectOne($c);

    return $vocab;

  } //getVocabularyByUri

  /**
  *
  * gets an array of Vocabulary objects related to a domain
  *
  * @return array Vocabulary
  */
  public static function getVocabulariesForDomain($domain)
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
  * gets the last update, either of the vocabulary or the history
  *
  * @return integer
  */
  public static function getLastUpdateDate($id)
  {
    $vocab = self::retrieveByPK($id);
    if ($vocab)
    {
      $lastVocabUpdate = $vocab->getLastUpdated(null);
    }
    $lastHistoryUpdate = ConceptPropertyHistoryPeer::getLastUpdateForVocab($id, null);
    $result = max(array($lastHistoryUpdate, $lastVocabUpdate));

    return $result;
  }

  /**
  * gets the property count
  *
  * @return integer
  */
  public static function getConceptCount($id)
  {
    $vocab = self::retrieveByPK($id);
    if ($vocab)
    {
      $result = $vocab->countConcepts();
    }

    return $result;
  }


  /**
   * gets a list of all agents related to all vocabs
   *
   * @return array Agents
   */
  public static function getVocabularyAgents()
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

} // VocabularyPeer
