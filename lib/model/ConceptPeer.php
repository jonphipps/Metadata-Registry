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
} // ConceptPeer