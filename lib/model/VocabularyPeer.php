<?php

  // include base peer class
  require_once 'model/om/BaseVocabularyPeer.php';
  
  // include object class
  include_once 'model/Vocabulary.php';


/**
 * Skeleton subclass for performing query and update operations on the 'reg_vocabulary' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class VocabularyPeer extends BaseVocabularyPeer {
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
    //get the last id
    $lastId = $vocabulary->getLastUriId();
    //increment it by one and set the last_id
    $nextId = ($lastId) ? ++$lastId : 100000;
    //we should theoretically set this when we save the concept, but it doesn't matter
    $vocabulary->setLastUriId($nextId);
    $vocabulary->save();
    return $nextId;
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

		$criteria->add(VocabularyPeer::URI, $uri);

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

} // VocabularyPeer