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

/**
* Set the defaults
*
* @param  ConceptProperty $concept_property
*/
  public function setDefaults ($concept_property)
  {
    $conceptId = $this->concept->getId();
    $conceptStatus = $this->concept->getStatusID();
    $conceptLanguage = $this->concept->getLanguage();
    $vocabId = $this->concept->getVocabularyId();

    $concept_property->setConceptId($conceptId);
    $concept_property->setStatusId($conceptStatus);
    $concept_property->setLanguage($conceptLanguage);
    $concept_property->setSchemeId($vocabId);

    parent::setDefaults($concept_property);
  }

  public function executeDelete()
  {
     $id = $this->getRequestParameter('id'); 
     $this->deleteReciprocalProperty($id);

      //check and correct filter if necessary
      $concept = $this->getUser()->getAttributeHolder()->get('concept');
      $this->getUser()->getAttributeHolder()->add(array('concept_id' => $concept->getId()), 'sf_admin/concept_property/filters');
      
      parent::executeDelete();
  }
  
  public function executeEdit ()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      //before the save...
      $concept_property = $this->getRequestParameter('concept_property');

      /**
      * @todo the list of skos property types that require a related concept should be in a master configuration array
      * this applies to the template too
      **/
      //check to see if the skosproperty requires a related concept
      if (!in_array($concept_property['skos_property_id'], array('3','16','21') ))
      {
         $concept_property['related_concept_id'] = null;
         $concept_property['scheme_id'] = null;
         //save the array back to the request parameter
         $this->requestParameterHolder->set('concept_property', $concept_property);
      }

      $conceptPropertyId = $this->getRequestParameter('id');
      if (isset($conceptPropertyId))
      {
         $this->deleteReciprocalProperty($conceptPropertyId, $concept_property['related_concept_id']);
      }
      
      if (isset($concept_property['related_concept_id']) and $concept_property['related_concept_id'])
      {
        //we want to lookup the URI of the related term
        $related_concept = ConceptPeer::retrieveByPK($concept_property['related_concept_id']);
        if ($related_concept)
        {
          //and overwrite whatever is in the current object TODO: move this into an javascript action in the user interface
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
        $newProp->setUpdatedUserId($this->getUser()->getSubscriberId());

        //TODO: make this the user's default language (actually the language is not relevant when defining relationships)
        //$newProp->setLanguage($this->concept->getLanguage());
        $newProp->setLanguage('');

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
    //there's no concept_id anywhere, so we get it by retrieving the conceptproperty object
    else
    {
      $conceptPropertyId = $this->getRequestParameter('id');
      if ($conceptPropertyId)
      {
         $conceptPropertyObj = ConceptPropertyPeer::retrieveByPK($conceptPropertyId);
         if ($conceptPropertyObj)
         {
            $conceptId = $conceptPropertyObj->getConceptId();
         }
      }
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
    //TODO: This shouldn't happen here
    //$this->forwardUnless($conceptId,'vocabulary','list');

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

  public function executeSearch ()
  {
	  $sort_column = $this->getRequestParameter('sort');
	  if ($sort_column)
	  {
			switch ($sort_column)
		  {
			 case 'concept_pref_label':
				$sort_column = ConceptPropertyPeer::CONCEPT_PREF_LABEL;
				break;
			 case 'vocabulary_name':
				$sort_column = ConceptPropertyPeer::VOCABULARY_NAME;
				break;
			 case 'skos_property_name':
				$sort_column = ConceptPropertyPeer::SKOS_PROPERTY_NAME;
				break;
			 case 'object':
				$sort_column = ConceptPropertyPeer::OBJECT;
				break;
		  }
		$this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/concept_search/sort');
		$this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/concept_search/sort');
	  }

	 if ($this->getRequest()->hasParameter('term'))
    {
      $this->getRequest()->setParameter('filter','filter');
      $filters = array('label' => $this->getRequestParameter('term'));
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_search/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/concept_search/filters');
	 }
	 $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/concept_search/filters');

    // pager
	 $this->pager = new sfPropelPager('ConceptProperty', 20);

	 $c = new Criteria();

	 //set sort criteria
	 if ($sort_column)
	 {
		if ($this->getUser()->getAttribute('type', null, 'sf_admin/concept_search/sort') == 'asc')
		{
		  $c->addAscendingOrderByColumn($sort_column);
		}
		else
		{
		  $c->addDescendingOrderByColumn($sort_column);
		}
	 }

	 if (isset($this->filters['label']) && $this->filters['label'] !== '')
    {
      $c->add(ConceptPropertyPeer::OBJECT, '%' . $this->filters['label'] . '%', Criteria::LIKE);
      $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID,
		  array(SkosPropertyPeer::LABEL_ID,
			 SkosPropertyPeer::LABEL_ALT_ID,
			 SkosPropertyPeer::LABEL_HIDDEN_ID,
			 SkosPropertyPeer::LABEL_PREF_ID), Criteria::IN);
    }

    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectSearchResults');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  } //executeSearch
  
  /**
  * checks for replated property and deletes if found
  *
  * @return return_type
  * @param  var_type $var
  */
  private function deleteReciprocalProperty($propertyId, $relatedIdFromRequest = '')
  {
      //retrieve the existing property
      if (isset($propertyId))
      {
         /* @var ConceptProperty */
         $currentProperty = ConceptPropertyPeer::retrieveByPk($propertyId);
      }
      if (isset($currentProperty))
      {
         //check to see if it defines a relationship
         $currentRelatedSchemeId = $currentProperty->getSchemeId();
         $currentRelatedConceptId = $currentProperty->getRelatedConceptId();
         $currentRelatedConceptInverseSkosId = $currentProperty->getSkosProperty()->getInverseId();
         //if it does and it doesn't match the current relationship
         if (isset($currentRelatedConceptId) && $currentRelatedConceptId != $relatedIdFromRequest)
         {
            //retrieve the related property
            $c = new Criteria();
            $c->add(ConceptPropertyPeer::CONCEPT_ID, $currentRelatedConceptId);
            $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, $currentRelatedConceptInverseSkosId);
            /* @var ConceptProperty */
            $relatedProperty = ConceptPropertyPeer::doSelectOne($c);
            if (isset($relatedProperty))
            {
               //then delete it
               try
               {
                  $relatedProperty->delete();
               }
               catch (PropelException $e)
               {
                  $this->getRequest()->setError('delete', 'Could not delete the related Concept Property.');
               }
            }      
         }
      }
     return;
  }
}