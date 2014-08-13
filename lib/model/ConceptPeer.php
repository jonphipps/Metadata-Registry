<?php

/**
 * Subclass for performing query and update operations on the 'reg_concept' table.
 *
 *
 *
 * @package lib.model
 */
class ConceptPeer extends BaseConceptPeer
{
	/** the column name for the VOCABULARY_NAME field */
	const VOCABULARY_NAME = 'reg_vocabulary.NAME';

	/** the column name for the AGENT_ID field */
	const AGENT_ID = 'reg_agent.ID';

	/** the column name for the AGENT_NAME field */
	const AGENT_NAME = 'reg_agent.ORG_NAME';

  /**
  * gets list of concepts for a vocabulary
  *
  * @return array an array of the form: $option[$option_value] = $option_text
  * @param  var_type $var
  */
  public static function getConceptsByVocabID($vocabId, $currentConceptId = null)
  {
    $c = new Criteria();

    $c->add(self::VOCABULARY_ID, $vocabId);
    if ($currentConceptId)
    {
       $c->add(self::ID, $currentConceptId, Criteria::NOT_EQUAL );
    }

    $results = self::doSelect($c);

    foreach ($results as $myCconcept)
    {
      $options[$myCconcept->getId()] = $myCconcept->getPrefLabel();
    }
    return $results;
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public static function getConceptsByCurrentVocabID()
  {
     $conceptProperty = sfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance()->concept_property;
     if ($conceptProperty)
     {
         $vocabId = $conceptProperty->getSchemeId();
     }
     else
     {
         $vocabId = sfContext::getInstance()->getUser()->getAttribute('vocabulary')->getId();
     }

     $concept = myActionTools::findCurrentConcept();
     if ($concept)
     {
       $conceptId = $concept->getId();
     }

     return self::getConceptsByVocabID($vocabId, $conceptId);
  }

  /**
   * description
   *
   * @return return_type
   */
  public static function getConceptsByRelatedVocabID()
  {
    /** @var ConceptProperty $conceptProperty */
    $conceptProperty = sfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance()->concept_property;
     if ($conceptProperty)
     {
         $vocabId = $conceptProperty->getSchemeId();
         //default to parent vocabid if schemeid is null
         $vocabId = $vocabId ? $vocabId : $conceptProperty->getConceptRelatedByConceptId()->getVocabularyId();
         $concept = $conceptProperty->getConceptRelatedByRelatedConceptId();
     }

     if ($concept)
     {
       $conceptId = $concept->getId();
     }

     return self::getConceptsByVocabID($vocabId);
  }

  /**
   * gets concept by concept URI
   *
   * @return Concept
   * @param $conceptUri
   */
  public static function getConceptByUri($conceptUri)
  {
    $c = new Criteria();
    $c->add(self::URI, $conceptUri);

    $concept = self::doSelectOne($c);

    return $concept;
  }

   /**
   * sets the criteria and returns the few columns needed for concept property search results
   *
   * @param Criteria $criteria The Criteria object used to build the SELECT statement.
	* @param Connection $con
	* @return array Array of selected Objects
	* @throws PropelException Any exceptions caught during processing will be
	*		 rethrown wrapped into a PropelException.
   */
   public static function doSelectSearchResults(Criteria $c, $con = null)
	{
		$c = clone $c;
      $c->clearSelectColumns();

      $c->addSelectColumn(ConceptPeer::ID);
      $c->addSelectColumn(ConceptPeer::PREF_LABEL);
      $c->addSelectColumn(ConceptPeer::UPDATED_AT);
      $c->addSelectColumn(ConceptPeer::VOCABULARY_ID);
      $c->addSelectColumn(VocabularyPeer::NAME);
      $c->addSelectColumn(AgentPeer::ID);
      $c->addSelectColumn(AgentPeer::ORG_NAME);

		$c->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$c->addJoin(VocabularyPeer::AGENT_ID, AgentPeer::ID);

      //populateObjects(ResultSet $rs)
      $rs = ConceptPeer::doSelectRS($c);
      $results = array();

		// set the class once to avoid overhead in the loop
		$cls = ConceptPeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next())
      {
         $startcol = 1;
			$obj = new $cls();
         try {
			   $obj->setId($rs->getInt($startcol + 0));
			   $obj->setprefLabel($rs->getString($startcol + 1));
			   $obj->setLastUpdated($rs->getTimestamp($startcol + 2, null));
			   $obj->setVocabularyId($rs->getInt($startcol + 3));
			   $obj->setVocabularyName($rs->getString($startcol + 4));
			   $obj->setAgentId($rs->getInt($startcol + 5));
			   $obj->setAgentName($rs->getString($startcol + 6));
		   } catch (Exception $e) {
			   throw new PropelException("Error populating Concept Search Results", $e);
		   }
			$results[] = $obj;
		} //while($rs->next())

      return $results;
   }

  /**
  * retrieves the vocabulary id for a concept
  *
  * @return integer the vocabulary Id
  * @param  integer $conceptId The concept to lookup
  */
  public static function getVocabularyIdForConcept($conceptId)
  {
    $concept = self::retrieveByPK($conceptId);
    /** @var Concept **/
    $vocabularyId = $concept->getVocabularyId();

    return $vocabularyId;
  }

  /**
   * Selects a collection of Concept objects filtered by history timestamp.
   *
   * @param integer $vocabularyId
   * @param date    $ts The timestamp
   * @return array Array of Concept objects.
   * @throws PropelException Any exceptions caught during processing will be
   *     rethrown wrapped into a PropelException.
   */
  public static function doSelectConceptByHistoryTimestamp($vocabularyId, $ts)
  {
    $c = new Criteria();
    $c->addJoin(ConceptPeer::ID, ConceptPropertyHistoryPeer::CONCEPT_ID);
    $c->setDistinct();

    $c->add(ConceptPeer::VOCABULARY_ID, $vocabularyId);
    $c->add(ConceptPropertyHistoryPeer::CREATED_AT, $ts, Criteria::LESS_EQUAL);
    $c->add(ConceptPropertyHistoryPeer::ACTION, 'deleted', Criteria::NOT_EQUAL);

    $results = ConceptPeer::populateObjects(ConceptPeer::doSelectRS($c));

    return $results;
  }


} // ConceptPeer
