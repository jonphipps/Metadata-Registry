<?php

require_once 'model/om/BaseConcept.php';


/**
 * Skeleton subclass for representing a row from the 'reg_concept' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Concept extends BaseConcept {

  public function __toString()
  {
    return $this->getConcept();
  }

  public function getConcept()
  {
    return $this->getPrefLabel();
  }

  /**
  * description
  *
  * @return return_type
  * @param  var_type $var
  */
  public function setprefLabel($v)
  {
    //check for an existing preflabel property
    $conceptProperty = '';
    if ($this->getId())
    {
      $c = new Criteria();
      $c->add(ConceptPeer::ID, $this->getId());
      $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosProperty::getPrefLabelId());
      $conceptPropertyColl = $this->getConceptPropertysRelatedByConceptId($c);
      if (isset($conceptPropertyColl[0]))
      {
        $conceptProperty = $conceptPropertyColl[0];
      }
      /* @var ConceptPropertyPeer $conceptProperty  */
    }
    if (!$conceptProperty)
    {
      $conceptProperty = new ConceptProperty();
      $conceptProperty->setSkosPropertyId(SkosProperty::getPrefLabelId());
    }
    $conceptProperty->setObject($v);
    $this->addConceptPropertyRelatedByConceptId($conceptProperty);
    parent::setPrefLabel($v);
    return;
  }

} // Concept
