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
    //a current vocabulary is required to be in the request URL
    myActionTools::requireVocabularyFilter();

    //clear any existing property filters since they don't apply now
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_property/filters');
    $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/concept_property_history/filters');
    parent::executeList();
  }

  /**
  * gets the current vocabulary object
  *
  * @return vocabulary current vocabulary object
  */
  public function getCurrentVocabulary()
  {
    $vocabulary = myActionTools::findCurrentVocabulary();

    if (!$vocabulary) //we have to do it the hard way
    {
      $this->concept = ConceptPeer::retrieveByPk($this->getRequestParameter('id'));
      $vocabulary = $this->concept->getVocabulary();
    }

    $this->forward404Unless($vocabulary,'No vocabulary has been selected.');

    $this->vocabulary = $vocabulary;
    $this->vocabularyID = $vocabulary->getId();

    return $vocabulary;
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

    $conceptParam = $this->getRequestParameter('concept');
    $userId =  $this->getUser()->getAttribute('subscriber_id','','subscriber');

    /** @var ConceptProperty **/
    $conceptProperty = $this->concept->getConceptProperty();

    if (!$conceptProperty)
    {
      $conceptProperty = new ConceptProperty();
      $conceptProperty->setSkosPropertyId(SkosProperty::getPrefLabelId());
      $conceptProperty->setCreatedUserId($userId);
      $conceptProperty->setPrimaryPrefLabel(1);

      $this->concept->setCreatedUserId($userId);
    }

    $conceptProperty->setUpdatedUserId($userId);

    if (isset($conceptParam['pref_label']))
    {
      $conceptProperty->setObject($conceptParam['pref_label']);
    }

    if (isset($conceptParam['language']))
    {
      $conceptProperty->setLanguage($conceptParam['language']);
    }

    if (isset($conceptParam['status_id']))
    {
      $conceptProperty->setStatusId($conceptParam['status_id']);
    }

    /** @var Concept $concept **/
    $concept = $this->concept;

    $updatedAt = time();
    $concept->setUpdatedAt($updatedAt);
    $conceptProperty->setUpdatedAt($updatedAt);

    //if we're in create mode...
    if ($concept->isNew())
    {
      $concept->save();

      $conceptProperty->setConceptRelatedByConceptId($concept);
      $conceptProperty->save();
    }
    else
    {
      $conceptProperty->setConceptRelatedByConceptId($concept);
    }

    //update the pref_label concept property
    $concept->setUpdatedUserId($userId);
    $concept->setConceptProperty($conceptProperty);
    $concept->save();

  }

/**
* disable the saveConcept function
*/
  protected function saveConcept($concept)
  {
    return;
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


