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
  public static function updateAdminFilters($attributeHolder, $filter, $value, $namespace)
  {
    $filters = $attributeHolder->get('filters', null, "sf_admin/$namespace/filters");
    $filters[$filter] = $value;

    $attributeHolder->removeNamespace("sf_admin/$namespace/filters");
    $attributeHolder->add($filters, "sf_admin/$namespace/filters");

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
  public static function requireVocabulary($module, $action)
  {
    $actionInstance = sfContext::getInstance()->getActionStack()->getLastEntry()->getActionInstance();
    /** @var Vocabulary **/
    $vocabulary = VocabularyPeer::findCurrentVocabulary();
    $actionInstance->forward404Unless($vocabulary,'No vocabulary has been selected.');

    //check to see if there's the correct request parameter
    $vocabularyId = $vocabulary->getId();
    $requestId = $actionInstance->getRequestParameter('vocabulary_id','');

    if ($vocabularyId && !strlen($requestId))
    {
      //let's add the correct parameter and redirect
      $param = array('module' => $module, 'action' => $action, 'vocabulary_id' => $vocabularyId);
      $actionInstance->redirect($param);
    }
    elseif ($vocabularyId != $requestId)
    {
      /**
      * @todo We really should  reset the vocabulary here if the request ID and the stored ID don't match
      **/
    }

    return;
  }
}
