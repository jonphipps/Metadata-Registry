<?php

require_once 'model/om/BaseConceptProperty.php';


/**
 * Skeleton subclass for representing a row from the 'reg_concept_property' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class ConceptProperty extends BaseConceptProperty {

  public function __toString()
  {
    return $this->getSkosProperty();
  }

  /**
  * returns the parent vocabulary
  *
  * @return vocabulary
  */
  public function getConceptVocabulary()
  {
    return $this->getConcept()->getVocabulary();
  }

} // ConceptProperty
