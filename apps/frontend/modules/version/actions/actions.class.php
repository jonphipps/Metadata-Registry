<?php

/**
 * version actions.
 *
 * @package    registry
 * @subpackage version
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */
class versionActions extends autoversionActions
{
  public function preExecute ()
  {
    $vocabulary = myActionTools::findCurrentVocabulary();

    $this->forward404Unless($vocabulary,'No vocabulary has been selected.');

    $this->vocabulary = $vocabulary;
    $this->vocabularyID = $vocabulary->getId();
    parent::preExecute();
  }

  /**
* Set the defaults
*
* @param  ConceptProperty $concept_property
*/
  public function setDefaults ($vocabulary_has_version)
  {
    //set the user id
    $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id','','subscriber');
    $vocabulary_has_version->setCreatedUserId($userId);

    //set the vocabulary id
    $vocabulary = myActionTools::findCurrentVocabulary();

    $this->forward404Unless($vocabulary,'No vocabulary has been selected.');

    $vocabulary_has_version->setVocabularyId($vocabulary->getId());

    //set the timeslice
    $ts = $this->getRequestParameter('ts');
    if($ts)
    {
      $vocabulary_has_version->setTimeslice($ts);
    }

    parent::setDefaults($vocabulary_has_version);
  }

  public function executeCancel()
  {
    $this->setFilter();
    parent::executeCancel();
  }

  public function executeDelete()
  {
    $this->setFilter();
    parent::executeDelete();
  }

  private function setFilter()
  {
    $vocabulary_id = $this->getUser()->getAttribute('vocabulary_id','','sf_admin/vocabulary_has_version/filters');
    $this->redirectFilter = '?vocabulary_id='. strval($vocabulary_id);
  }

}
