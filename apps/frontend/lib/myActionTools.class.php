<?php
class myActionTools
{
  /**
  * update the currently set filters
  *
  * @return none
  * @param  string $filter the name of the filtet, typically from the query string
  * @param  string $value the value of the filter
  * @param  string $namespace the local filter namespace ('sf_admin/$namespace/filters')
  */
  public static function updateAdminFilters(sfParameterHolder $attributeHolder, $filter, $value, $namespace)
  {
    $attributeHolder->set($filter, $value, "sf_admin/$namespace/filters");

    return;
  }

  /**
  * require that there be a vocabulary
  *
  * returns a 404 if no vocabulary has already been selected
  * Peforms a redirect if one has but the param has not been added to the request
  *
  * @param  string $module The calling module
  * @param  string $action The calling action
  */
  public static function requireVocabularyFilter()
  {
    $actionInstance = sfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    /** @var Vocabulary **/
    $vocabulary = self::findCurrentVocabulary();
    /* @var sfAction */
    $actionInstance->forward404Unless($vocabulary,'No vocabulary has been selected.');

    //check to see if there's the correct request parameter
    $vocabularyId = $vocabulary->getId();
    $requestId = $actionInstance->getRequestParameter('vocabulary_id','');

    if ($vocabularyId && !strlen($requestId))
    {
      //let's add the correct parameter
      //and add in any other params and redirect
      $params = sfContext::getInstance()->getRequest()->getParameterHolder()->getAll() + array('vocabulary_id' => $vocabularyId);
      $actionInstance->redirect($params);
    }
    elseif ($vocabularyId != $requestId)
    {
      /**
      * @todo We really should reset the vocabulary here if the request ID and the stored ID don't match
      **/
    }

    return;
  }

   /**
  * require that there be a concept
  *
  * returns a 404 if no vocabulary has already been selected
  * Peforms a redirect if one has but the param has not been added to the request
  *
  */
  public static function requireConceptFilter()
  {
    $actionInstance = sfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    /** @var Concept **/
    $concept = self::findCurrentconcept();
    /* @var sfAction */
    $actionInstance->forward404Unless($concept,'No concept has been selected.');

    //check to see if there's the correct request parameter
    $conceptId = $concept->getId();
    $requestId = $actionInstance->getRequestParameter('concept_id','');

    if ($conceptId && !strlen($requestId))
    {
      //let's add the correct parameter
      //and add in any other params and redirect
      $params = sfContext::getInstance()->getRequest()->getParameterHolder()->getAll() + array('concept_id' => $conceptId);
      $actionInstance->redirect($params);
    }
    elseif ($conceptId != $requestId)
    {
      /**
      * @todo We really should reset the concept here if the request ID and the stored ID don't match
      **/
    }

    return;
  }

  /**
  * gets the current vocabulary object
  *
  * @return mixed current vocabulary object, or false
  */
  public static function findCurrentVocabulary()
  {
    $instance = sfContext::getInstance();
    $user = $instance->getUser();
    $request = $instance->getRequest();
    $action = $instance->getActionStack()->getLastEntry()->getActionInstance();
    $attributeHolder = $user->getAttributeHolder();

    //check if there's a request parameter
    $vocabularyId = $request->getParameter('vocabulary_id','');

    //vocabulary_id's in the query string
    if ($vocabularyId)
    {
      self::updateAdminFilters($attributeHolder, 'vocabulary_id', $vocabularyId, 'concept');
    }

    //vocabulary_id's not in the query string, but it's in a filter
    //note: this will still return the correct value if it's in the query string
    $vocabularyId = $attributeHolder->get('vocabulary_id','','sf_admin/concept/filters');

    $vocabulary = $user->getCurrentVocabulary();

    //We got here and there's a vocabulary_id but we didn't get the stored vocabulary object
    if ($vocabularyId && !$vocabulary)
    {
      //we get it from the database
      $vocabulary = self::setLatestVocabulary($vocabularyId);
    }

    //we got here and there's a vocabulary and a vocabularyid (yay)
    if ($vocabulary and $vocabularyId)
    {
      //let's check the id of the stored vocabulary
      $currentId = $vocabulary->getId();

      //but what if the id of that vocabulary doesn't match the one we have
      if ($currentId != $vocabularyId)
      {
        //we set the stored object to be the one we know
        $vocabulary = self::setLatestVocabulary($vocabularyId);
      }
    }

    //if we get here and there's still no vocabulary then we return false
    $vocabulary = (isset($vocabulary)) ? $vocabulary : false;

    return $vocabulary;
  }

  /**
  * description
  *
  * @return Vocabulary Current vocabulary object
  * @param  integer $vocabId
  */
  public static function setLatestVocabulary($vocabId)
  {
    $vocabObj = VocabularyPeer::retrieveByPK($vocabId);
    sfContext::getInstance()->getUser()->setCurrentVocabulary($vocabObj);
    return $vocabObj;
  }

  /**
  * gets the current concept object
  *
  * @return mixed current concept object, or false
  */
  public static function findCurrentConcept()
  {
    $instance = sfContext::getInstance();
    $user = $instance->getUser();
    $request = $instance->getRequest();
    $action = $instance->getActionStack()->getLastEntry()->getActionInstance();
    $attributeHolder = $user->getAttributeHolder();

    //check if there's a request parameter
    $conceptId = $request->getParameter('concept_id','');

    //concept_id's in the query string
    if ($conceptId)
    {
      self::updateAdminFilters($attributeHolder, 'concept_id', $conceptId, 'concept_property');
    }

    //concept_id's not in the query string, but it's in a filter
    //note: this will still return the correct value if it's in the query string
    $conceptId = $attributeHolder->get('concept_id','','sf_admin/concept_property/filters');

    $concept = $user->getCurrentConcept();

    //We got here and there's a concept_id but we didn't get the stored concept object
    if ($conceptId && !$concept)
    {
      //we get it from the database
      $concept = self::setLatestConcept($conceptId);
    }

    //we got here and there's a concept and a conceptid (yay)
    if ($concept and $conceptId)
    {
      //let's check the id of the stored concept
      $currentId = $concept->getId();

      //but what if the id of that concept doesn't match the one we have
      if ($currentId != $conceptId)
      {
        //we set the stored object to be the one we know
        $concept = self::setLatestConcept($conceptId);
      }
    }
    //if we get here and there's still no vocabulary then we return false
    $concept = (isset($concept)) ? $concept : false;

    return $concept;
  }


  /**
  * description
  *
  * @return Concept Current concept object
  * @param  integer $vocabId
  */
  public static function setLatestConcept($vocabId)
  {
    $vocabObj = ConceptPeer::retrieveByPK($vocabId);
    sfContext::getInstance()->getUser()->setCurrentConcept($vocabObj);
    return $vocabObj;
  }

}
