<?php

/**
 * concept actions.
 *
 * @package    registry
 * @subpackage concept
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 22 2006-04-22 00:33:21Z jphipps $
 */
class conceptActions extends autoconceptActions
{

  public function preExecute ()
  {
    $this->getCurrentVocabulary();
    parent::preExecute();
  }

/**
* Set defaults
*
* @param  Concept $concept
*/
  public function setDefaults($concept)
  {
    $vocabObj = $this->getCurrentVocabulary();
    $vocabId = $vocabObj->getId();
    $concept->setVocabularyId($vocabId);

    $conceptParam = $this->getContext()->getRequest()->getParameter('concept');
    if (!$this->getContext()->getRequest()->getErrors() and !isset($conceptParam['uri']))
    {
      $vocabDomain = $vocabObj->getBaseDomain();
      $vocabToken = $vocabObj->getToken();
      //get the next id
      $nextUriId = VocabularyPeer::getNextConceptId($vocabId);
      //URI looks like: agent(base_domain) / vocabulary(token) / vocabulary(next_concept_id) / skos_property_id # concept(next_property_id)
      $vSlash = preg_match('@(/$)@i', $vocabDomain) ? '' : '/';
      $tSlash = preg_match('@(/$)@i', $vocabToken ) ? '' : '/';
      $newURI = $vocabDomain . $vSlash . $vocabToken . $tSlash . $nextUriId;
      //registry base domain is http://metadataregistry.org/uri/
      //next_concept_id is always initialized to 100000, allowing for 999,999 concepts
      //vocabulary carries denormalized base_domain from agent

      $concept->setUri($newURI);
      $concept->setprefLabel('');
      //set to the vocabulary defaults
      $concept->setLanguage($vocabObj->getLanguage());
      $concept->setStatusId($vocabObj->getStatusId());
    }

    parent::setDefaults($concept);
  }

  public function executeList ()
  {
    //clear any existing detail filters
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_property/filters');
    parent::executeList();
  }

  /**
  * gets the current vocabulary object
  *
  * @return vocabulary current vocabulary object
  */
  public function getCurrentVocabulary()
  {
    //check if there's a request parameter     
    $vocabId = $this->getRequestParameter('vocabulary_id');

    //vocabulary_id's in the query string
    if ($vocabId)
    {
      $attributeHolder = $this->getUser()->getAttributeHolder();
      myActionTools::updateAdminFilters($attributeHolder, 'vocabulary_id', $vocabId, 'concept');
    }
    //vocabulary_id's not in the query string, but it's in a filter
    elseif (isset($this->filters['vocabulary_id']) && $this->filters['vocabulary_id'] !== '')
    {
      $vocabId = $this->filters['vocabulary_id'];
    }

    $vocabObj = $this->getUser()->getCurrentVocabulary();

    //there's a vocabulary_id but no vocabulary object
    if ($vocabId && !$vocabObj)
    {
      $vocabObj = $this->setLatestVocabulary($vocabId);
    }

    if ($vocabObj)
    {
      $currentId = $this->getUser()->getCurrentVocabulary()->getId();

      if (isset($vocabId) and $vocabId and $currentId != $vocabId)
      {
        $vocabObj = $this->setLatestVocabulary($vocabId);
      }

      $vocabId = $this->getUser()->getCurrentVocabulary()->getId();
    }

    //$this->getUser()->getVocabularyCredentials($vocabId);

    //current vocabulary can't be retrieved, so we send back to the list
    //TODO: forward to an intermediate error page
    //TODO: This shouldn't happen here
    //$this->forwardUnless($vocabId,'vocabulary','list');

    return $vocabObj;
  }
  /**
  * description
  *
  * @return vocabulary current vocabulary object
  * @param  integer $vocabId
  */
  public function setLatestVocabulary($vocabId)
  {
    $vocabObj = VocabularyPeer::retrieveByPK($vocabId);
    $this->getUser()->setCurrentVocabulary($vocabObj);
    return $vocabObj;
  }

  public function executeProperties()
  {
    $this->redirect('/conceptprop/list?concept_id=' . $this->getRequestParameter('id') );
  }
  
  public function executeGetConceptList()
  {
     $vocabId = $this->getRequestParameter('selectedVocabularyId');
     $conceptId = sfContext::getInstance()->getUser()->getAttribute('concept')->getId();
     $results = ConceptPeer::getConceptsByVocabID($vocabId, $conceptId);
     foreach ($results as $myCconcept)
     {
        $options[$myCconcept->getId()] = $myCconcept->getPrefLabel();
     }
     if (!isset($options))
     {
         $options[''] = 'There are no related concepts to select';
     }
     $this->concepts = $options;
  }

  public function updateConceptFromRequest()
  {
    parent::updateConceptFromRequest();

    //bail if there are errors
    if ($this->getRequest()->hasErrors())
    {
      return;
    }

    $concept = $this->getRequestParameter('concept');
    $id = $this->getRequestParameter('id');

    //check for an existing preflabel property
    $conceptProperty = '';
    if ($id)
    {
      $c = new Criteria();
      $c->add(ConceptPropertyPeer::CONCEPT_ID, $id);
      $c->add(ConceptPropertyPeer::SKOS_PROPERTY_ID, SkosProperty::getPrefLabelId());
      $c->add(ConceptPropertyPeer::LANGUAGE, $concept['language']);

      /* @var ConceptPropertyPeer $conceptProperty  */
      $conceptProperty = ConceptPropertyPeer::doSelectOne($c);
    }

    if (!$conceptProperty)
    {
      $conceptProperty = new ConceptProperty();
      $conceptProperty->setSkosPropertyId(SkosProperty::getPrefLabelId());
    }

    if (isset($concept['pref_label']))
    {
      $conceptProperty->setObject($concept['pref_label']);
    }
    if (isset($concept['language']))
    {
      $conceptProperty->setLanguage($concept['language']);
    }
    if (isset($concept['status_id']))
    {
      $conceptProperty->setStatusId($concept['status_id']);
    }

    //update the pref_label concept property
    $conceptProperty->save();

  }

  protected function getConceptOrCreate($id = 'id')
  {
    if (!$this->getRequestParameter($id))
    {
      $concept = new Concept();
      $this->setDefaults($concept);
    }
    else
    {
      $concept = ConceptPeer::retrieveByPk($this->getRequestParameter($id));

      $this->forward404Unless($concept);
    }

    return $concept;
  }


}


