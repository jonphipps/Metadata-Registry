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

  /**
  * gets the current vocabulary object
  *
  * @return mixes current vocabulary object or false
  */
  public static function findCurrentVocabulary()
  {
    $instance = sfContext::getInstance();
    $user = $instance->getUser();
    $request = $instance->getRequest();
    $action = $instance->getActionStack()->getLastEntry()->getActionInstance();

    $vocabulary = false;

    //check if there's a request parameter
    $vocabularyId = $request->getParameter('vocabulary_id','');

    //vocabulary_id's in the query string
    if ($vocabularyId)
    {
      $attributeHolder = $user->getAttributeHolder();
      myActionTools::updateAdminFilters($attributeHolder, 'vocabulary_id', $vocabularyId, 'concept');
    }
    //vocabulary_id's not in the query string, but it's in a filter
    elseif (isset($action->filters['vocabulary_id']) && $action->filters['vocabulary_id'] !== '')
    {
      $vocabularyId = $action->filters['vocabulary_id'];
    }

    $vocabulary = $user->getCurrentVocabulary();

    //We got here and there's a vocabulary_id but we didn't get the stored vocabulary object
    if ($vocabularyId && !$vocabulary)
    {
      //we get it from the database
      $vocabulary = self::setLatestVocabulary($vocabularyId);
    }

    //we got here and there's a vocabulary and a vocabularyid (yay)
    if ($vocabulary and $vocabularyId)
    {
      //let's check the id of the stored vocabulary
      $currentId = $vocabulary->getId();

      //but what if the id of that vocabulary doesn't match the one we have
      if ($currentId != $vocabularyId)
      {
        //we set the stored object to be the one we know
        $vocabulary = self::setLatestVocabulary($vocabularyId);
      }
    }

    //if we get here and there's still no vocabulary then we return false
    return $vocabulary;
  }


  /**
  * description
  *
  * @return Vocabulary Current vocabulary object
  * @param  integer $vocabId
  */
  public static function setLatestVocabulary($vocabId)
  {
    $vocabObj = VocabularyPeer::retrieveByPK($vocabId);
    sfContext::getInstance()->getUser()->setCurrentVocabulary($vocabObj);
    return $vocabObj;
  }

} // VocabularyPeer
