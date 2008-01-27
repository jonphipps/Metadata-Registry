<?php

/**
 * Subclass for representing a row from the 'reg_concept_property_history' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ConceptPropertyHistory extends BaseConceptPropertyHistory
{
  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getScheme()
  {
    $scheme = VocabularyPeer::retrieveByPK($this->getSchemeId());

    if ($scheme)
    {
      return $scheme->getName();
    }
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getRelatedConcept()
  {
    $concept = ConceptPeer::retrieveByPK($this->getRelatedConceptId());

    if ($concept)
    {
      return $concept->getPrefLabel();
    }
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getPrefLabel()
  {
    return $this->getConceptRelatedByConceptId()->getPrefLabel();
  }
  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function getUri()
  {
    return $this->getConceptRelatedByConceptId()->getUri();    
  }
  
  /**
  * gets the previous change if the action is 'modified'
  *
  * @return ConceptPropertyHistory object
  * @param  string $historyTimestamp
  * @param  string $propertyId
  */
  function getPrevious()
  {
    $propertyId = $this->getConceptPropertyId();
    $timestamp = $this->getCreatedAt();

    //build the query string
    $c = new Criteria();
    $crit0 = $c->getNewCriterion(ConceptPropertyHistoryPeer::CONCEPT_PROPERTY_ID, $propertyId);
    $crit1 = $c->getNewCriterion(ConceptPropertyHistoryPeer::CREATED_AT, $timestamp, Criteria::LESS_THAN);

    // Perform AND at level 0 ($crit0 $crit1 )
    $crit0->addAnd($crit1);
    $c->add($crit0);
    
    //set order and limits
    $c->setLimit(1);
    $c->addDescendingOrderByColumn(ConceptPropertyHistoryPeer::CREATED_AT);
    
    $result = ConceptPropertyHistoryPeer::doSelect($c);
    
    //return the resulting object
    if (count($result))
    {
        $result = $result[0];
    }
    
    return $result;
  }
}
