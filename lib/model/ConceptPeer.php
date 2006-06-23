<?php

  // include base peer class
  require_once 'model/om/BaseConceptPeer.php';
  
  // include object class
  include_once 'model/Concept.php';


/**
 * Skeleton subclass for performing query and update operations on the 'reg_concept' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class ConceptPeer extends BaseConceptPeer {

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
  public function getConceptsByVocabID($vocabId)
  {
    $c = new Criteria();

    $c->add(self::VOCABULARY_ID, $vocabId);

    $results = self::doSelect($c);

    foreach ($results as $myCconcept)
    {
      $options[$myCconcept->getId()] = $myCconcept->getPrefLabel();
    }
    return $options;
  }

  /**
  * gets concept by concept URI
  *
  * @return Concept
  * @param  var_type $var
  */
  public function getConceptByUri($conceptUri)
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
      $c->addSelectColumn(ConceptPeer::LAST_UPDATED);
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

} // ConceptPeer