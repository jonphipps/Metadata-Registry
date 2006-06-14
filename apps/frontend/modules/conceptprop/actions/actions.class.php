<?php

/**
 * conceptprop actions.
 *
 * @package    registry
 * @subpackage conceptprop
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 22 2006-04-22 00:33:21Z jphipps $
 */
class conceptpropActions extends autoconceptpropActions
{
  /**
  * extends parent preExecute method
  *
  */
  public function preExecute ()
  {
    $this->concept = $this->getCurrentConcept();
    parent::preExecute();
  }

  public function executeCreate ()
  {
    $conceptId = $this->concept->getId();
    $vocabId = $this->concept->getVocabularyId();

    $this->concept_property = new ConceptProperty();
    $this->concept_property->setConceptId($conceptId);
    $this->concept_property->setSchemeId($vocabId);

    //TODO: set this more dynamically based on the user's default language
    $this->concept_property->setLanguage('en');
  }

  public function executeEdit ()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      //before the save...
      //if there's a related term
      $concept_property = $this->getRequestParameter('concept_property');
      if (isset($concept_property['related_concept_id']) and $concept_property['related_concept_id'])
      {
        //we want to lookup the URI of the related term
        $related_concept = ConceptPeer::retrieveByPK($concept_property['related_concept_id']);
        if ($related_concept)
        {
          //and overwrite whatever is in the current object TODO: move this into an AJAX action in the user interface
          $concept_property['object'] = $related_concept->getUri();
          $this->getRequest()->getParameterHolder()->set('concept_property', $concept_property);
        }
        //lookup the inverse id
        $InverseSkosId = SkosPropertyPeer::retrieveByPK($concept_property['skos_property_id'])->getInverseId();
        //then we create a new reciprocal property in the related term
        $newProp = new ConceptProperty();
        $newProp->setConceptId($concept_property['related_concept_id']);
        $newProp->setSkosPropertyId($InverseSkosId);
        $newProp->setSchemeId($this->concept->getVocabularyId());
        $newProp->setRelatedConceptId($this->concept->GetId());
        $newProp->setObject($this->concept->getUri());
        //TODO: make this the user's default language
        $newProp->setLanguage('en');
        $newProp->save();
      }
    }
    parent::executeEdit();
  }

  /**
  * gets the name of the parent vocabulary
  *
  * @return string
  * @param  none
  */
  public function getVocabularyName()
  {
    return $this->concept->getVocabulary()->getName();
  }

  /**
  * gets the id of the parent vocabulary
  *
  * @return string
  * @param  none
  */
  public function getVocabularyId()
  {
    return $this->concept->getVocabulary()->getId();
  }

  /**
  * gets the current vocabulary object
  *
  * @return vocabulary current vocabulary object
  */
  public function getCurrentConcept()
  {
    //check if there's a request parameter
    $conceptId = $this->getRequestParameter('concept_id');
    $conceptObj = $this->getUser()->getCurrentConcept();

    if ($conceptId)
    {
      $attributeHolder = $this->getUser()->getAttributeHolder();
      myActionTools::updateAdminFilters($attributeHolder, 'concept_id', $conceptId, 'concept_property');
    }
    //concept_id's not in the query string, but it's in a filter
    elseif (isset($this->filters['concept_id']) && $this->filters['concept_id'] !== '')
    {
      $conceptId = $this->filters['concept_id'];
    }
    //there's a concept_id but no vocabulary object
    if ($conceptId && !$conceptObj)
    {
      $conceptObj = $this->setLatestConcept($conceptId);
    }

    if ($conceptObj)
    {
      $currentId = $this->getUser()->getCurrentConcept()->getId();
      if (isset($conceptId) and $currentId != $conceptId)
      {
        $conceptObj = $this->setLatestConcept($conceptId);
      }
      $conceptId = $this->getUser()->getCurrentConcept()->getId();
    }

    //current Concept can't be retrieved, so we send back to the vocabulary list
    //TODO: make this smarter and check for a vocabulary. If there is, go back to the concepts for it instead
    //TODO: forward to an intermediate error page
    $this->forwardUnless($conceptId,'vocabulary','list');

    return $conceptObj;
  }
  /**
  * description
  *
  * @return Concept current Concept object
  * @param  integer $conceptId
  */
  public function setLatestConcept($conceptId)
  {
    $conceptObj = ConceptPeer::retrieveByPK($conceptId);
    $this->getUser()->setCurrentConcept($conceptObj);
    return $conceptObj;
  }

}

