<?php

/**
 * Subclass for performing query and update operations on the 'reg_concept_property' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ConceptPropertyPeer extends BaseConceptPropertyPeer
{
	/** the column name for the VOCABULARY_ID field */
	const VOCABULARY_ID = 'reg_concept.VOCABULARY_ID';

	/** the column name for the VOCABULARY_NAME field */
	const VOCABULARY_NAME = 'reg_vocabulary.NAME';

	/** the column name for the SKOS_PROPERTY_NAME field */
	const SKOS_PROPERTY_NAME = 'reg_skos_property.NAME';

	/** the column name for the PREF_LABEL field */
	const CONCEPT_PREF_LABEL = 'reg_concept.PREF_LABEL';

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

		$c->addSelectColumn(ConceptPropertyPeer::ID);
		$c->addSelectColumn(ConceptPropertyPeer::LANGUAGE);
		$c->addSelectColumn(ConceptPropertyPeer::OBJECT);
		$c->addSelectColumn(ConceptPropertyPeer::SKOS_PROPERTY_ID);

		$c->addSelectColumn(ConceptPeer::ID);
		$c->addSelectColumn(ConceptPeer::PREF_LABEL);

		$c->addSelectColumn(ConceptPeer::VOCABULARY_ID);
		$c->addSelectColumn(VocabularyPeer::NAME);

		$c->addSelectColumn(SkosPropertyPeer::LABEL);

		$c->addJoin(ConceptPeer::VOCABULARY_ID, VocabularyPeer::ID);
		$c->addJoin(ConceptPropertyPeer::CONCEPT_ID, ConceptPeer::ID);
		$c->addJoin(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosPropertyPeer::ID);

      //populateObjects(ResultSet $rs)
		$rs = self::doSelectRS($c);
      $results = array();

		// set the class once to avoid overhead in the loop
		$cls = self::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next())
      {
			$startcol = 1;
			$obj = new $cls();
         try {
			   $obj->setId($rs->getInt($startcol + 0));
			   $obj->setLanguage($rs->getString($startcol + 1));
			   $obj->setObject($rs->getString($startcol + 2));
			   $obj->setSkosPropertyId($rs->getInt($startcol + 3));
			   $obj->setConceptId($rs->getInt($startcol + 4));
				$obj->setConceptPrefLabel($rs->getString($startcol + 5));
				$obj->setVocabularyId($rs->getInt($startcol + 6));
				$obj->setVocabularyName($rs->getString($startcol + 7));
				$obj->setSkosPropertyName($rs->getString($startcol + 8));
		   } catch (Exception $e) {
			   throw new PropelException("Error populating Concept Search Results", $e);
		   }
			$results[] = $obj;
		} //while($rs->next())

      return $results;
   }

} // ConceptPropertyPeer
