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
}
