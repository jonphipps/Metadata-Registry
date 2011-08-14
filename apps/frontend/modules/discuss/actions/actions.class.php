<?php

/**
* discuss actions.
*
* @package    registry
* @subpackage discuss
* @author     Jon Phipps <jonphipps@gmail.com>
* @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
*/
class discussActions extends autodiscussActions
{
  /**
  * extends parent preExecute method
  *
  */
  public function preExecute ()
  {
    parent::preExecute();
  }

  public function executeList ()
  {
    $idType = $this->getRequestParameter('IdType', null);
    $id = $this->getRequestParameter('id', null);

    if(!$idType)
    {
      //a current vocabulary is required to be in the request URL
      myActionTools::requireVocabularyFilter();
    }
    else
    {
      $this->getRequest()->getParameterHolder()->set($idType, $id);
    }

    $vocabulary = myActionTools::findCurrentVocabulary();
    $this->vocabulary = $vocabulary;

    if (in_array($idType, array('concept_id','property_id')))
    {
      $this->concept = myActionTools::findCurrentConcept();
      $this->setFlash('hasConcept', true);
    }

    //get the versions array
    $c = new Criteria();
    $c->add(VocabularyHasVersionPeer::VOCABULARY_ID, $vocabulary->getId());
    $versions = VocabularyHasVersionPeer::doSelect($c);
    $this->setFlash('versions', $versions);

    parent::executeList();
  }

  /**
  * Set the defaults
  *
  * @param  ConceptProperty $concept_property
  */
  public function setDefaults ($discuss)
  {
    $action = $this->getRequest()->getParameter('action');

    if ('create' == strtolower($action))
    {
      $filter = $this->getUser()->getAttributeHolder()->getAll('sf_admin/discuss/filters');
      //we need to get all the numbers
      if ($filter && is_array($filter))
      {
        $filterKey = array_keys($filter);
        try
        {
          switch ($filterKey[0])
          {
            case "property":
              $property = ConceptPropertyPeer::retrieveByPK($filter[$filterKey[0]]);
              $concept = $property->getConceptRelatedByConceptId();
              $vocabId = $concept->getVocabularyId();
              $vocabulary = myActionTools::findCurrentVocabulary();

              /** @var Discuss **/
              $discuss->setConceptProperty($property);
              $discuss->setConcept($concept);
              $discuss->setVocabularyId($vocabId);
              break;
            case "concept_id":
              $concept = ConceptPeer::retrieveByPK($filter[$filterKey[0]]);
              $vocabId = $concept->getVocabularyId();
              /** @var Discuss **/
              $discuss->setConcept($concept);
              $discuss->setVocabularyId($vocabId);
            case "vocabulary_id":
              $vocabId = VocabularyPeer::retrieveByPK($filter[$filterKey[0]]);
              /** @var Discuss **/
              $discuss->setVocabularyId($vocabId);
              break;
            default:
          }
        }
        catch (Exception $e)
        {
        }
      }
    }
    else
    {
    }

    parent::setDefaults($discuss);
  }


}
